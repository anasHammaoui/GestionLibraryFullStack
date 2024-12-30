<?php
include "../model/database.php";
include "book.php";
    $connection = new DataBase("localhost","library","root","");
    $connection -> conn();
    $db = $connection -> setConn();
    $bookClass = new Books($db);
        // search
     // search book
     if (isset($_GET["search"])){
        $return = $bookClass -> search($_GET["search"]);
       echo $return;
       exit;
      }
?>