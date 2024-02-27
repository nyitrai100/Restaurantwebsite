
<?php
try {
    $conn = new PDO('mysql:host=localhost;port=8100;dbname=TheGrillSmith', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Oh no, there was a problem" . $exception->getMessage();
}

$allTimeSlots = [];
$allTablesInfo = [];
$reservedTablesInfo = [];
$availableTimeSlots = [];
$selectedTableId = null;
$unbookedTablesExist = false;

// if request has sent to get available timeslots
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['branch_id'])) {

    // get all values from form submission
    $selectedBranchId = $_GET['branch_id'];
    $selectedGuestAmount = (int) $_GET['numOfGuest'];
    $selectedDate = $_GET['date'];

    // this will prevent the website from finding tables with 2 more seats than the guest amount (it is not financially reseaonable to allow 2 guests to book 10 seats table)
    $limitEmptyTable = $selectedGuestAmount + 2;

    // this query will get all timeslots from timeslot table
    $allTimeSlotQuery = "SELECT id, arrival_time from timeslot";

    $stmt = $conn->prepare($allTimeSlotQuery);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $allTimeSlots[] = $row['arrival_time'];
    }

    // $reservedTableInfoQuery = "SELECT arrival_time as timeslot, table_id as tid, maximum_capacity as table_seats 
    //                        FROM Reservation re
    //                        JOIN Restauranttable rest ON rest.id = re.table_id
    //                        JOIN Branch b ON b.id = rest.branch_id
    //                        JOIN Timeslot t ON t.Id = re.time_slot_id
    //                        WHERE b.id = ? AND re.reservation_date = ? AND rest.maximum_capacity BETWEEN ? AND ?
    //                        ORDER BY timeslot";

    // this query will get all reserved tables for that date with maximum capacity of amount of guest + 2 from entered branch.
    // the query is counting the number of times the table is booked on that date and list the rows in ascending order so that
    // the table with the least amount of books stays at the top.
    // this will useful in situation when all tables are booked but we want to show user which tables has most available timeslots (least booked means more available timeslots)
    $reservedTableInfoQuery = "SELECT table_id as tid, maximum_capacity as table_seats, COUNT(arrival_time) as timesBooked 
                                                FROM Reservation re
                                                JOIN Restauranttable rest ON rest.id = re.table_id
                                                JOIN Branch b ON b.id = rest.branch_id
                                                JOIN Timeslot t ON t.Id = re.time_slot_id
                                                WHERE b.id = ? AND re.reservation_date = ? AND rest.maximum_capacity BETWEEN ? AND ?
                                                GROUP BY table_id
                                                ORDER BY timesBooked";

    $stmt = $conn->prepare($reservedTableInfoQuery);
    $stmt->bindParam(1, $selectedBranchId, PDO::PARAM_INT);
    $stmt->bindParam(2, $selectedDate, PDO::PARAM_STR);
    $stmt->bindParam(3, $selectedGuestAmount, PDO::PARAM_INT);
    $stmt->bindParam(4, $limitEmptyTable, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Create an object for each row and add it to the array
        $object = new stdClass();
        foreach ($row as $key => $value) {
            $object->$key = $value;
        }
        $reservedTablesInfo[] = $object;
    }

    // this query will get All Tables from restauranttable that matches branch, date and guest amount criteria
    $allTableInfoQuery = "SELECT rest.Id as tid, maximum_capacity as table_seats
                        FROM Restauranttable rest
                        JOIN Branch b ON b.id = rest.branch_id
                        WHERE b.id = ? AND rest.maximum_capacity BETWEEN ? AND ?";

    $stmt = $conn->prepare($allTableInfoQuery);
    $stmt->bindParam(1, $selectedBranchId, PDO::PARAM_INT);
    $stmt->bindParam(2, $selectedGuestAmount, PDO::PARAM_INT);
    $stmt->bindParam(3, $limitEmptyTable, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Create an object for each row and add it to the array
        $object = new stdClass();
        foreach ($row as $key => $value) {
            $object->$key = $value;
        }
        $allTablesInfo[] = $object;
    }

    // Function to filter out objects from $array1 that exist in $array2
    function filterObjects($array1, $array2, $identifier)
    {
        // Function to check if an object exists in the second array
        $objectExistsInArray = function ($object) use ($array2, $identifier) {
            foreach ($array2 as $item) {
                if ($item->$identifier == $object->$identifier) {
                    return true;
                }
            }
            return false;
        };

        // Use array_filter with a custom callback function to filter out objects present in the second array
        return array_values(array_filter($array1, function ($object) use ($objectExistsInArray) {
            return !$objectExistsInArray($object);
        }));
    }

    // this will filtered out all reserved tables from all tables. thereby, getting all tables that hasn't been booked yet on that particular date that matches criteria (assuming if there's any)
    $allTablesExcludingReserved = filterObjects($allTablesInfo, $reservedTablesInfo, 'tid');

    // check if there's any tables that isn't booked yet
    if (!empty($allTablesExcludingReserved)) {
        // if they exist, get one table and its id. Let user knows all timeslots for that table is available
        $selectedTableId = $allTablesExcludingReserved[0]->tid;
        $availableTimeSlots = $allTimeSlots;
        $unbookedTablesExist = true;
    } else {
        // if there isn't any unbooked table for that date, we want to get the table with the least amount of times booked
        // since reservedTableInfo is ordered based on the amount of times booked (ascending), we will just have to get the top one
        $tableWithLeastTimeslot = $reservedTablesInfo[0];

        // this will get all timeslots that are reserved for that table on that date
        $timeSlotsOfReservedTableQuery = "SELECT arrival_time
                                                FROM Reservation re
                                                JOIN Timeslot t ON t.Id = re.time_slot_id
                                                WHERE re.table_id = ? AND re.reservation_date = ?";

        $stmt = $conn->prepare($timeSlotsOfReservedTableQuery);
        $stmt->bindParam(1, $tableWithLeastTimeslot["tid"], PDO::PARAM_INT);
        $stmt->bindParam(2, $selectedDate, PDO::PARAM_STR);

        $timeSlotsOfReservedTable = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $timeSlotsOfReservedTable[] = $row['arrival_time'];
        }

        // get timeslots that are not reserved
        $availableTimeSlots = array_diff($allTimeSlots, $timeSlotsOfReservedTable);
        // get table id
        $selectedTableId = $tableWithLeastTimeslot['tid'];
        $unbookedTablesExist = false;
    }

    // after all of this, all tables are booked for the entire day, attach noTimeSlots query param to let user know
    if (empty($availableTimeSlots)) {
        header("Location: ../booking.php?noTimeSlots=true");
    }
} else {
    header('Location: ../booking.php');
}
