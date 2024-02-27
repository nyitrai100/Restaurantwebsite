<?php
include("header.php");
include("./database.php");

// foreach ($BranchNames as $fields) {
//   foreach ($fields as $key => $value) {
//     echo "$key: $value \n";
//   }
// }

// the following code checks if there is noTimeSlots value from query param (checking if there are any timeslots availavble for that date)
$noAvailTimeSlot = false;

if (isset($_GET['noTimeSlots'])) {
  $noAvailTimeSlot = (bool) $_GET['noTimeSlots'];
}

?>
<div class="p-10 md:p-52 bg-black text-white min-h-[100vh]">
  <div class="flex items-center justify-center p-12 bg-gray-200 rounded">
    <div class="mx-auto w-full max-w-[550px]">
      <h1 class="flex justify-center pb-20 text-black text-5xl">Booking Form</h1>
      <form action="./Manage_Booking/confirm_booking.php" method="GET">
        <div class="-mx-3 flex flex-wrap">

          <div class="w-full px-3">
            <div class="mb-5">
              <label for="branch" class="text-black">Choose the Branch</label>
              <select id="branch" name="branch_id" class="w-full text-black">
                <?php
                if (!empty($BranchNames)) {
                  foreach ($BranchNames as $BranchName) {
                    echo "<option value='{$BranchName['branch_id']}'>'{$BranchName['branch_name']}'</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <div class="mb-5 w-full">
            <label for="guest" class="mb-3 block text-base font-medium text-[#07074D]">
              How many guests are you bringing?
            </label>
            <input type="number" min="1" max="10" name="numOfGuest" id="guest" placeholder="5" min="0" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required />
          </div>

          <div class="mb-5 w-full">
            <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
              Date
            </label>
            <input type="date" name="date" id="date" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required />
          </div>
        </div>
        <?php
        if ($noAvailTimeSlot) {
          echo "<p class='text-center text-red-600 mb-5'>Please choose another date. All tables are fully booked for that day!</p>";
        }
        ?>
        <button type="submit" class="w-full hover:shadow-form rounded-md bg-blue-700 py-3 px-8 text-center text-base font-semibold text-white outline-none">
          Search for timeslot
        </button>
      </form>
    </div>
  </div>
</div>


<?php
include("footer.php");
?>