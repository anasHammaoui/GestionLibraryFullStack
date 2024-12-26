<?php
      include "../model/database.php";
      include "users.php";
      session_destroy();
      session_start();
      $users = null;
     if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $db = new DataBase("localhost","library","root","");
      $db -> conn();
      $connect = $db -> setConn();
      $users = new Users(); 
     }
?>