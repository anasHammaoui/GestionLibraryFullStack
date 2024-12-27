<?php
include "../model/database.php";
include "users.php";
if (session_status() == PHP_SESSION_ACTIVE) {
      session_destroy();
}
session_start();
$users = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $db = new DataBase("localhost", "library", "root", "");
      $db->conn();
      $connect = $db->setConn();
      $users = new Users($connect);
}
