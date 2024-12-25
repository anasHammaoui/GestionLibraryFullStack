<?php
    include "../model/database.php";
    session_start();
    if (isset($_SESSION["userRole"])){
        if ($_SESSION["userRole"] == "admin"){
            echo "it's admin";
        } else {
            echo "Error in Sessions, you're not admin";
            die();
        }
    } else {
        echo "not set";
    }
    
?>