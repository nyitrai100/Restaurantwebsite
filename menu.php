<?php
include("header.php");
?>

<div class="min-h-[100vh] bg-black p-10">

    <div class="flex justify-around p-10 foodMenuDiv">
        <img class="h-auto max-w-lg rounded-lg pt-10" src="./Pictures/Menu-1.jpg" alt="Menu-1">
        <img class="h-auto max-w-lg rounded-lg pt-10" src="./Pictures/Menu-2.jpg" alt="Menu-2">
    </div>

    <div class="flex justify-around p-10 drinkMenuDiv">
        <img class="h-auto max-w-lg rounded-lg pt-10" src="./Pictures/Drink-1.jpg" alt="Drink-1">
        <img class="h-auto max-w-lg rounded-lg pt-10" src="./Pictures/Drink-2.jpg" alt="Drink-2">
    </div>

    <!--  button with a link to download the menu -->
    <div class="text-center pt-10">
        <a href="download.php" download="your-file-name.pdf">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Download PDF Menu
            </button>
        </a>
    </div>

</div>

<?php
include("footer.php");
?>
