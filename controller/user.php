<?php
    include "../model/database.php";
    include "../controller/book.php";
    session_start();
    if (isset($_SESSION["userRole"])){
        if ($_SESSION["userRole"] != "authenticated"){
            die();
        } else {
            $connect = new DataBase("localhost","library","root","");
    $connect -> conn();
    $connection = $connect ->setConn();
    $bookClass = new Books($connection);
             // show books
    $showBooks = $bookClass -> show();
        }
    } else {
        echo "You Have to Sign in to access this page:)";
        die();
    }
    
?>