<?php
    include_once "user.php";
    include_once "categoriesClass.php";
    include_once "borrowClass.php";

    $catClass = new Categories($connection);
    $borrowClass = new Borrow($connection);
    $borrowMsg = null;
    // borrow book
    if (isset($_POST["borrow"])) {
        $borrowClass -> borrow($_POST["user-id"],$_POST["book-id"],$_POST["date-borrow"],$_POST["date-due"]);
        $borrowMsg = "Borrow request is sent successfully";
        echo "
        <script>
            setTimeout(()=>{
            window.location.href = 'userDash.php';
            }, 3000);
        </script>
        ";
    } 
    // return book
    if (isset($_POST["return"])){
        $borrowClass -> returnBook($_POST["returnId"]);
        $borrowMsg = "The book has been returned successfully";
        echo "
        <script>
            setTimeout(()=>{
            window.location.href = 'userDash.php';
            }, 3000);
        </script>
        ";
    }
    // reserve book
    if (isset($_POST["reserve"])){
        $borrowClass -> reserveBook($_POST["user-id"],$_POST["book-id"],$_POST["date-due"]);
        $borrowMsg = "The book has been reserved successfully";
        echo "
        <script>
            setTimeout(()=>{
            window.location.href = 'userDash.php';
            }, 3000);
        </script>
        ";
    }
    // show borrowed or resereved books
    $showBorrow = $borrowClass -> showBorrowed($_SESSION["userId"]);

?>