<?php
include "../controller/book.php";
include "../model/database.php";
$connect = new DataBase("localhost","library","root","");
$connect -> conn();
$connection = $connect ->setConn();
$bookClass = new Books($connection);
// show books
$showBooks = $bookClass -> show();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven - Discover Great Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                    </svg>
                 
                    <h1 class="text-2xl font-bold text-gray-900">Ebook</h1>
                 
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search books..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <a
                  class="text-sm font-medium text-white dark:text-purple-400 hover:underline  m-12 bg-indigo-700 p-2 "
                  href="signUphtml.php"
                >
                  Create account
                </a>
            </div>
        </div>
       
              
    </header>

    <!-- Hero Section -->
    <div class="bg-indigo-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl font-extrabold tracking-tight sm:text-5xl">
                    Discover Your Next Great Read
                </h2>
               
            </div>
        </div>
    </div>

    <!-- Books Grid -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php for ($i = 0; $i < count($showBooks); $i++) { ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="relative h-64">
                    <img src="<?= $showBooks[$i]["cover_image"] ?>" alt="Book cover" class="w-full h-44 object-cover rounded">
                </div>
                <div class="p-4">
                    <h3 class="font-medium text-gray-900 text-lg"><?= $showBooks[$i]["title"] ?></h3>
                    <p class="text-sm text-gray-600">Author: <?= $showBooks[$i]["author"] ?></p>
                    <p class="text-sm text-gray-600">Summary: <?= $showBooks[$i]["summary"] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</main>


</body>

</html>