<?php 
//   include("./Database/dbh.php");
  include("header.php");
?>



<div class="p-10 md:p-20 bg-black">
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
</div>


<?php 
include("footer.php");
?>