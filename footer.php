
<footer class="bg-white shadow dark:bg-gray-900 ">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="./" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="logo.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">The GrillSmith</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="./about.php" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="./menu.php" class="hover:underline me-4 md:me-6">Menu</a>
                </li>
                <li>
                    <a href="./contact.php" class="hover:underline me-4 md:me-6">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 MARRCBK. All Rights Reserved.</span>
        <?php if(isset($_SESSION["user"]))
                {   echo  "<p class='ms-2 flex text-white text-sm hover:underline me-4 md:me-6 sm:justify-center'>{$_SESSION['user']}</p>" ;
                    echo '<a href="./Authentication/logout.php" class="ms-2 flex text-white text-sm hover:underline me-4 md:me-6 sm:justify-center">Log out</a>';}
                else{echo'<a href="loginPage.php" class="ms-2 flex text-white text-sm hover:underline me-4 md:me-6 sm:justify-center">Admin</a>';}
                ?>
      <li>
    </div>
</footer>
</body>
</html>