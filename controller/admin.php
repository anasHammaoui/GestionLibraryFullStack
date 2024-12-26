<?php
    include "../model/database.php";
    session_start();
    if (isset($_SESSION["userRole"])){
        if ($_SESSION["userRole"] != "admin"){
            die();
        } 
    } else {
        echo "You Have to Sign in to access this page:)";
        die();
    }
    
?>