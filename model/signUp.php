<?php
    include "database.php";
    $database = new Database("localhost", "library","root","");
     $database->conn();
     $connection = $database -> setConn() ;
    var_dump($connection);
?>