<?php
    include "categoriesClass.php";
    include "../model/database.php";
    $connection = new DataBase("localhost","library","root","");
    $connection -> conn();
    $connect = $connection -> setConn();
    // show categories 
    $catClass = new Categories($connect);
    $showCats = $catClass -> showCategories();
    // add categories
    if (isset($_POST["addCategory"])){
        $catClass -> addCategory($_POST["add-category"]);
        header("location: ../view/categoriesPage.php");
        exit();
    }
    // delete category
    if (isset($_POST["deleteCat"])){
        $catClass -> delCategory($_POST["delete-cat"]);
        header("location: ../view/categoriesPage.php");
        exit();
    }
    // edit category
    if (isset($_POST["editCat"])){
        $catClass -> editCategory($_POST["CatId"],$_POST["edit-cat"]);
        header("location: ../view/categoriesPage.php");
        exit();
    }
    
?>