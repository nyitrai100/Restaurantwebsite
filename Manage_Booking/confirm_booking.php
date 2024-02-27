<?php
include("../header.php");
include("./get_available_timeslots.php");

$selectedBranchId = $_GET['branch_id'];
$selectedGuestAmount = (int) $_GET['numOfGuest'];
$selectedDate = $_GET['date'];
?>
<div class="p-10 md:p-52 bg-black text-white min-h-[100vh]">
    <div class="flex items-center justify-center p-12 bg-gray-200 rounded">
        <div class="mx-auto w-full max-w-[550px]">
            <h1 class="flex justify-center pb-20 text-black text-5xl">Booking Form</h1>
            <form action="./submit_booking.php" method="POST">

                <input type="hidden" name="date" value="<?= $selectedDate ?>" />
                <input type="hidden" name="tableId" value="<?= $selectedTableId ?>" />

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label for="time" class="mb-3 block text-base font-medium text-[#07074D]">
                                Available timeslots
                            </label>
                            <select id="time" name="timeSlot" class="w-full block appearance-none w-24 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-400" required>
                                <?php
                                foreach ($availableTimeSlots as $availTimeSlot) {
                                    echo "<option class='text-gray-500' value='$availTimeSlot'>$availTimeSlot</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                                First Name
                            </label>
                            <input required type="text" name="fName" id="fName" placeholder="First Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                                Last Name
                            </label>
                            <input required type="text" name="lName" id="lName" placeholder="Last Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="mb-5">
                        <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                            Email
                        </label>
                        <input required type="email" name="email" id="email" placeholder="example@gmail.com" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>

                <div class="w-full">
                    <div class="mb-5">
                        <label for="tel" class="mb-3 block text-base font-medium text-[#07074D]">
                            Phone number
                        </label>
                        <input required type="tel" name="phoneNo" id="tel" placeholder="07934543567" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
                <div class="w-full flex justify-between">
                    <a href="../booking.php" class="hover:shadow-form rounded-md bg-blue-700 py-3 px-8 text-center text-base font-semibold text-white outline-none">Restart Booking Process</a>
                    <button type="submit" class="hover:shadow-form rounded-md bg-blue-700 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Reserve Seat
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>


<?php
include("../footer.php");
?>