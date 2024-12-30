<?php
include "../controller/users.php";
$connect = new DataBase("localhost", "library", "root", "");
$connect->conn();
$connection = $connect->setConn();
$usersClass = new users($connection);
// show users
$showUsers = $usersClass->showUsers();
// edit users
if (isset($_POST["editusers"])) {
    $usersClass->edit($_POST["usersId"], $_POST["role"]);
    header("location: adminDash.php");
}
// delete users
if (isset($_GET["deleteUsers"])) {
    $usersClass->delete($_GET["delete-users"]);
    header("location: adminDash.php");
}
// 
