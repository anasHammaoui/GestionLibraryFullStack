<?php
      include "../controller/admin.php";
      include "../controller/book.php";
    $connect = new DataBase("localhost","library","root","");
    $connect -> conn();
    $connection = $connect ->setConn();
    $bookClass = new Books($connection);
    // show books
    $showBooks = $bookClass -> show();
    // edit books
    if (isset($_POST["editBook"])){
      $bookClass -> edit($_POST["edit-name"],$_POST["edit-cat"], $_POST["author-name"],$_POST["newStatus"],$_POST["bookId"],$_POST["edit-desc"]);
      header("location: booksAdmin.php");
    }
?>