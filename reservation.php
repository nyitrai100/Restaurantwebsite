<?php 
  include("./database.php");
  include("header.php");
?>



<div class="pt-10 md:p-20 bg-black flex justify-center">

<div class="m-2 max-w-screen ">
  <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
    <h2 class="text-stone-700 text-xl font-bold">Apply filters</h2>
    <p class="mt-1 text-sm">Use filters to further refine search</p>
    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      <div class="flex flex-col">
        <label for="name" class="text-stone-600 text-sm font-medium">Name</label>
        <input type="text" id="name" placeholder="John Doe" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
      </div>

      <div class="flex flex-col">
        <label for="email" class="text-stone-600 text-sm font-medium">Email</label>
        <input type="email" id="email" placeholder="example@gmail.com" class="mt-2 block w-full rounded-md border border-gray-200 px-1 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
      </div>

      <div class="flex flex-col">
        <label for="date" class="text-stone-600 text-sm font-medium">Booked Date</label>
        <input type="date" id="date" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
      </div>

      <!-- <div class="flex flex-col">
        <label for="status" class="text-stone-600 text-sm font-medium">Status</label>

        <select id="status" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
          <option>Dispached Out</option>
          <option>In Warehouse</option>
          <option>Being Brought In</option>
        </select>
      </div> -->
    </div>

    <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
      <button class="active:scale-95 rounded-lg bg-gray-200 px-8 py-2 font-medium text-gray-600 outline-none focus:ring hover:opacity-90">Reset</button>
      <button class="active:scale-95 rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
    </div>
  </div>
</div>

</div>



<!-- <div class="p-10 md:p-20 bg-black">
<div class="overflow-x-auto rounded">
  <table class="min-w-full bg-white font-[sans-serif]">
    <h1 class="text-white text-2xl pb-10 flex "> Reservation Table</h1>
    <thead class="bg-gray-800 whitespace-nowrap">
      <tr>
        <th class="px-6 py-3 text-left text-sm font-semibold text-white">
          Name
        </th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-white">
          Email
        </th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-white">
          Phone
        </th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-white flex justify-center">
          Number of guest
        </th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-white ">
          Booking date
        </th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-white flex justify-center">
          Booking time
        </th>
      </tr>
    </thead>
    <tbody class="whitespace-nowrap">
      <tr class="even:bg-blue-50">
        <td class="px-6 py-4 text-sm">
          John Doe
        </td>
        <td class="px-6 py-4 text-sm">
          john@example.com
        </td>
        <td class="px-6 py-4 text-sm">
          07563546547
        </td>
        <td class="px-6 py-4 text-sm flex justify-center">
          4
        </td>
        <td class="px-6 py-4">
            2024-05-15
        </td>
        <td class="px-6 py-4 flex justify-center">
            15:00
        </td>
      </tr>

      <tr class="even:bg-blue-50">
        <td class="px-6 py-4 text-sm">
          Jane Smith
        </td>
        <td class="px-6 py-4 text-sm">
          jane@example.com
        </td>
        <td class="px-6 py-4 text-sm">
          07845634586
        </td>
        <td class="px-6 py-4 text-sm flex justify-center">
          6
        </td>
        <td class="px-6 py-4">
             2024-07-20
        </td>
        <td class="px-6 py-4 flex justify-center">
             08:00
        </td>
      </tr>

      <tr class="even:bg-blue-50">
        <td class="px-6 py-4 text-sm">
          John Doe
        </td>
        <td class="px-6 py-4 text-sm">
          john@example.com
        </td>
        <td class="px-6 py-4 text-sm">
          07563546547
        </td>
        <td class="px-6 py-4 text-sm flex justify-center">
          4
        </td>
        <td class="px-6 py-4">
            2024-05-15
        </td>
        <td class="px-6 py-4 flex justify-center">
            15:00
        </td>
      </tr>

      <tr class="even:bg-blue-50">
        <td class="px-6 py-4 text-sm">
          Jane Smith
        </td>
        <td class="px-6 py-4 text-sm">
          jane@example.com
        </td>
        <td class="px-6 py-4 text-sm">
          07845634586
        </td>
        <td class="px-6 py-4 text-sm flex justify-center">
          6
        </td>
        <td class="px-6 py-4">
             2024-07-20
        </td>
        <td class="px-6 py-4 flex justify-center">
             08:00
        </td>
      </tr>
      


    </tbody>
  </table>
</div>
</div> -->



<!-- Reservation table generated from the database -->

<?php
        if (!empty($reservations)) {
            echo "<table class=''>
                    <thead>
                        <tr class=''>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Reservation Date</th>
                            <th> Cancel <th>
                           </tr>
                    </thead>
                    <tbody>";
                    foreach ($reservations as $reservation) {
                        echo "<tr>
                                <td class='flightsTableFlight1'>{$reservation['first_name']} {$reservation['last_name']}</td>
                                <td class='flightsTableFlight2'>{$reservation['email']}</td>
                                <td class='flightsTableFlight3'>{$reservation['phone_number']}</td>
                                <td class='flightsTableFlight4'>{$reservation['reservation_date']}</td>
                                <td> <button> Cancel</button> </td>
                                </tr>";
                    }
        
                    echo "</tbody></table>";
                } else {
                    echo "<p>No matching flights found.</p>";
                }
         ?>





<?php 
include("footer.php");
?>