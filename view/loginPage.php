<?php
  include "../controller/login.php"
?>

<!DOCTYPE html>
<html  x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Library</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
   
  </head>
  <body>
    <!-- show error message after form is submeted and it's not good -->
  <?php
   if ($users){ ?> 
   <div class="bg-rose-500 py-2 text-center font-bold text-lg text-white"><?= $users->login($connect, $_POST["email"],$_POST["password"]); ?></div>
 <?php }?>
  

    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="img/login.jpeg"
              alt="books"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="img/login.jpeg"
              alt="books"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <form class="w-full" action="<?php htmlspecialchars("login.php")?>" method="POST">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Login
              </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                type="email"
                name="email"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border p-2"
                  placeholder="contact@email.co"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border p-2"
                  placeholder="***************"
                  type="password"
                  name="password"
                />
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <input type="submit" name="login"
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                 value="Log in"
              >
                

              <hr class="my-8" />

              <p class="mt-1">
                You don't have an account?
                <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="signUphtml.php"
                >
                  Create account
                </a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
