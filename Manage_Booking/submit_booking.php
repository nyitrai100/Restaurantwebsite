<?php
try {
    $conn = new PDO('mysql:host=localhost;port=3306;dbname=thegrillsmith', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Oh no, there was a problem" . $exception->getMessage();
}

// check if the request has been made with required values
if ($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['tableId'])) {

    // get all values from form submission
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];

    // transform phoneNumber data from 07------- to +44-------
    $phoneNo = substr($_POST['phoneNo'], 1);
    $editedPhoneNo = "+44" . $phoneNo;

    $selectedTableId = $_POST['tableId'];
    $selectedTimeSlot = $_POST['timeSlot'];
    $selectedDate = $_POST['date'];
    $timeSlotId = null;

    // the reserved table stores timeslot id instead of the actual time
    // for that reason the following query will get that timeslotId of that selected timeslot
    $getTimeSlotIdQuery = "SELECT id FROM timeslot WHERE arrival_time = :timeSlot";

    $stmt = $conn->prepare($getTimeSlotIdQuery);
    $stmt->bindParam(':timeSlot', $selectedTimeSlot, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $timeSlotId = $row['id'];
    }

    // this will finally save data to reservation table
    $bookReservationQuery = "INSERT INTO reservation (first_name, last_name, reservation_email, reservation_date, phone_number, time_slot_id, table_id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($bookReservationQuery);
    $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
    $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);
    $stmt->bindParam(4, $selectedDate, PDO::PARAM_STR);
    $stmt->bindParam(5, $editedPhoneNo, PDO::PARAM_STR);
    $stmt->bindParam(6, $timeSlotId, PDO::PARAM_INT);
    $stmt->bindParam(7, $selectedTableId, PDO::PARAM_INT);


    // check if the data is properly stored
    if ($stmt->execute()) {
        // if so, let user know their table Id
        header('Location: ./booking_feedback.php?tableId=' . $selectedTableId);
    } else {
        echo "<h2>Something went wrong!</h2>";
    }
}
