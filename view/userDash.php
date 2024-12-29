<?php
include "../controller/user.php";
include "../controller/categoriesClass.php";
include "../controller/borrowClass.php";
$catClass = new Categories($connection);
    $borrowClass = new Borrow($connection);
    $borrowMsg = null;
    if (isset($_POST["borrow"])) {
        $borrowClass -> borrow($_POST["user-id"],$_POST["book-id"],$_POST["date-borrow"],$_POST["date-due"],$_POST["date-return"]);
        $borrowMsg = "Borrow request is sent successfully";
        echo "
        <script>
            setTimeout(()=>{
            window.location.href = 'userDash.php';
            }, 3000);
        </script>
        ";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebook - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sidebar transitions */
.sidebar-transition {
    transition: transform 0.3s ease-in-out;
}

@media (max-width: 768px) {
    .sidebar-hidden {
        transform: translateX(-100%);
    }
}
      /* Modal styles */
.modal-container {
    backdrop-filter: blur(4px);
}

.modal-container form {
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        transform: translateY(-10%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
    </style>
</head>
<body class="bg-gray-50">
    <div class="bg-green-500 text-white p-2 font-bold text-lg text-center"><?=  $borrowMsg ? $borrowMsg : "Good Morning"?></div>
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:static w-64 bg-white shadow-lg h-full z-30  sidebar-transition sidebar-hidden md:sidebar-hidden-none">
            <div class="h-full flex flex-col">
                <!-- Sidebar Header -->
                <div class="p-4 border-b">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                        </svg>
                        <span class="text-lg font-semibold">My Library</span>
                    </div>
                </div>

                <!-- Books List -->
                <div class="flex-1 overflow-y-auto p-4">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">My Books</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800" alt="Book cover" class="w-12 h-16 object-cover rounded">
                            <div>
                                <p class="font-medium text-gray-900">The Midnight Library</p>
                                <p class="text-sm text-gray-500">Matt Haig</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800" alt="Book cover" class="w-12 h-16 object-cover rounded">
                            <div>
                                <p class="font-medium text-gray-900">Project Hail Mary</p>
                                <p class="text-sm text-gray-500">Andy Weir</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sign Out Button -->
                <div class="p-4 border-t">
                    <a href="loginPage.php" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Sign Out
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Burger Menu for Mobile -->
                            <button class="md:hidden" onclick="toggleSidebar()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <h1 class="text-2xl font-bold text-gray-900">Ebook</h1>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Search books..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto">
                <!-- Hero Section -->
                <div class="bg-indigo-700 text-white py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <h2 class="text-4xl font-extrabold tracking-tight sm:text-5xl">
                                Discover Your Next Great Library
                            </h2>
                            <p class="mt-4 text-xl text-indigo-100">
                                Explore our curated collection of bestsellers, classics, and hidden gems
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Books Grid -->
                <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php
                        for ($i =0; $i < count($showBooks);$i++){ ?>

                            <!-- Book Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                            <div class="relative h-64">
                                <img src="<?= $showBooks[$i]["cover_image"] ?>" alt="The Midnight Library" class="w-full h-full object-cover">
                                <span class="absolute top-0 right-0 bg-rose-500 p-2 text-white font-bold"><?= $showBooks[$i]["status"] ?></span>
                            </div>
                            <div class="p-4">
                                <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider"><?= $showCats = $catClass -> showCat($showBooks[$i]["category_id"]); ?>
                                </span>
                                <h3 class="mt-2 text-xl font-bold text-gray-900"><?= $showBooks[$i]["title"] ?></h3>
                                <p class="mt-1 text-gray-600"><?= $showBooks[$i]["author"] ?></p>
                                <span class="mt-1 text-gray-600"><?= $showBooks[$i]["summary"] ?></span>
                                <button class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md flex items-center justify-center gap-2 hover:bg-indigo-700 transition-colors"   aria-label="borrow"
                                onclick="toggleModal('<?= $showBooks[$i]['title'] ?>')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                                    </svg>
                                    Borrow Now
                                </button>
                    
                      </div>
                            </div>
                                          <!-- Modal -->
                      <div 
                          id="<?= $showBooks[$i]['title'] ?>" 
                          class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4"
                      >
                          <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6 relative">
                          <?php
                                    if ($showBooks[$i]["status"] != "borrowed"){ ?>
                                <form action="userDash.php" method="POST" class="space-y-4">
                                  <!-- user Id -->
                                  <div>
                                      <input 
                                          type="text" 
                                          name="user-id" 
                                          value="<?= $_SESSION["userId"] ?>" 
                                          class="mt-1 hidden w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>

                                  <!-- book id -->
                                  <div>
                                      <input 
                                          type="text" 
                                          name="book-id" 
                                          value="<?= $showBooks[$i]['id'] ?>" 
                                          class="mt-1 w-full hidden rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>

                                  <!-- borrow date -->
                                  <div>
                                      <label class="block text-sm font-medium text-gray-700">Borrow Date</label>
                                      <input 
                                          type="date" 
                                          name="date-borrow" 
                                          class="mt-1 border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>
                                  <!-- due date -->
                                  <div>
                                      <label class="block text-sm font-medium text-gray-700">Due date</label>
                                      <input 
                                          type="date" 
                                          name="date-due" 
                                          class="mt-1 border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>
                                  <!-- return date -->
                                  <div>
                                      <label class="block text-sm font-medium text-gray-700">Return date</label>
                                      <input 
                                          type="date" 
                                          name="date-return" 
                                          class="mt-1 border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>

                           

                                  <!-- Actions -->
                                  <div class="flex justify-end gap-3 mt-6">
                                      <button 
                                          type="button"
                                          onclick="toggleModal('<?= $showBooks[$i]['title'] ?>')"
                                          class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                                      >
                                          Cancel
                                      </button>
                                      <button 
                                          type="submit"
                                          name="borrow"
                                          class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700"
                                      >
                                          Borrow Book
                                      </button>
                                  </div>
                              </form>

                                   <?php } else {
                                    echo "the book is already borrowed";
                                   }
                                ?>
                          </div>
                        </div>
                            
                     <?php   }
                       ?>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="bg-gray-900 text-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        <div class="text-center">
                            <p class="text-gray-400">© 2024 Ebook. All rights reserved.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    sidebar.classList.toggle('sidebar-hidden');
    overlay.classList.toggle('hidden');
}
    // modal borrow book
      function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.toggle('hidden');
    }
}

// Close modal when clicking outside
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('fixed')) {
        e.target.classList.add('hidden');
    }
});
    </script>
</body>
</html>