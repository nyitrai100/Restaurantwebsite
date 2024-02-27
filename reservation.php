<?php
include("header.php");
include("./database.php");

function filterReservationBasedOnKeys(array $reserves, array $filters): array
{
  // Use array_filter to iterate through each object in the array
  // and apply a callback function to filter out items based on their key values
  return array_filter($reserves, function ($reserve) use ($filters) {
    // Iterate through each filter
    foreach ($filters as $key => $value) {
      // Check if the array has the specified key and its value matches the provided value
      if (!isset($reserve[$key]) || $reserve[$key] !== $value) {
        return false; // the array doesn't match the filter, so exclude it
      }
    }
    return true; // Array matches all filters, so include it
  });
}

$reservations = $reservationRBS;
$fallbackText = "No reservation has been made yet for this branch.";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['reLastName']) || isset($_GET['reEmail']) || isset($_GET['reReservationDate']))) {
  $filters = [];

  foreach ($_GET as $key => $value) {
    if (!empty($value)) {
      $filters[$key] = $value;
    }
  }

  $reservations = filterReservationBasedOnKeys($reservations, $filters);

  if (empty($reservations)) {
    $fallbackText = "No matching reservation found. Try filtering with other values.";
  }
} else {
  $reservations = $reservationRBS;
}

?>



<form method="GET" action="">
  <div class="pt-10 md:p-20 bg-black flex justify-center">
    <div class="m-2 max-w-screen ">
      <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
        <h2 class="text-stone-700 text-xl font-bold">Apply filters</h2>
        <p class="mt-1 text-sm">Use filters to further refine search</p>
        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          <div class="flex flex-col">
            <label for="name" class="text-stone-600 text-sm font-medium">Last Name</label>
            <input type="text" id="name" name="reLastName" placeholder="Doe" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
          </div>

          <div class="flex flex-col">
            <label for="email" class="text-stone-600 text-sm font-medium">Email</label>
            <input type="email" name="reEmail" id="email" placeholder="example@gmail.com" class="mt-2 block w-full rounded-md border border-gray-200 px-1 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
          </div>

          <div class="flex flex-col">
            <label for="date" class="text-stone-600 text-sm font-medium">Booked Date</label>
            <input type="date" name="reReservationDate" id="date" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
          </div>
        </div>

        <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
          <!-- <button class="active:scale-95 rounded-lg bg-gray-200 px-8 py-2 font-medium text-gray-600 outline-none focus:ring hover:opacity-90">Reset</button> -->
          <button type="submit" class="active:scale-95 rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
        </div>
      </div>
    </div>

  </div>
</form>



<!-- Reservation table generated from the database -->

<?php
if (!empty($reservations)) {


  echo "
            <div class='p-10 md:p-20 bg-black'>
            <div class='overflow-x-auto rounded'>
             <table class='min-w-full bg-white font-[sans-serif]'>
             <h1 class='text-white text-2xl pb-10 flex'> Reservation Table</h1>
                    <thead class='bg-gray-800 whitespace-nowrap'>
                        <tr class='even:bg-blue-50'>
                            <th class='px-6 py-3 text-left text-sm font-semibold text-white'>Branch</th>
                            <th class='px-6 py-3 text-left text-sm font-semibold text-white'>Name</th>
                            <th class='px-6 py-3 text-left text-sm font-semibold text-white'>Email Address</th>
                            <th class='px-6 py-3 text-left text-sm font-semibold text-white'>Phone Number</th>
                            <th class='px-6 py-3 text-left text-sm font-semibold text-white'>Reservation Date</th>
                            <th class='px-6 py-3 text-left text-sm font-semibold text-white'> Cancel <th>
                           </tr>
                    </thead>
                    <tbody class='whitespace-nowrap'>
 
                    ";
  foreach ($reservations as $reservationRB) {
    echo "<tr class='even:bg-blue-50'>
                               <td class='px-6 py-4 text-sm'>{$reservationRB['reBranchName']}</td>
                                <td class='px-6 py-4 text-sm'>{$reservationRB['reFirstName']} {$reservationRB['reLastName']}</td>
                                <td class='px-6 py-4 text-sm'>{$reservationRB['reEmail']}</td>
                                <td class='px-6 py-4 text-sm'>{$reservationRB['rePhoneNumber']}</td>
                                <td class='px-6 py-4 text-sm text-center'>{$reservationRB['reReservationDate']}</td>
                                <td class='px-6 py-4 text-sm'> 
                                  <form id='cancel_reserve' method='POST' action='./Manage_Booking/cancel_reservation.php'>
                                    <input type='hidden' name='reserveId' value='{$reservationRB['reId']}' />
                                    <input type='submit' class='bg-red-500 rounded p-2 text-white cursor-pointer' value='Cancel' />
                                  </form>
                                </td>
                                </tr>";
  }

  echo "</tbody></table>               </div> </div>";
} else {
  echo "<h5 class='m-10 text-center font-semibold'>$fallbackText</h5>";
}
?>




<?php
include("footer.php");
?>