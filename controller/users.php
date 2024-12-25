<?php
    class Users {
        protected $email;
        protected $password;
        protected $db;
       public function __construct($db,$email, $pass){
        $this -> email = $email;
        $this -> password = $pass;
        $this -> db = $db;
       }
       public function login(){
        $email = $this -> email;
        $checkEmail = $this -> db -> prepare("SELECT email, password, role,id FROM users WHERE email = :email");
       $checkEmail -> bindParam(":email",$email);
       $checkEmail -> execute();
       $count = $checkEmail -> fetch(PDO::FETCH_ASSOC);
       if ($count){
        if ($count["password"] === $this -> password){
           if ($count["role"] === "authenticated"){
            header("location: userDash.php");
            $_SESSION["userRole"] = "authenticated";
            $_SESSION["userId"] = $count["id"];
            $this -> db =null;
            exit();
           } elseif ($count["role"] === "admin"){
            header("location: adminDash.php");
            $_SESSION["userRole"] = "admin";
            $_SESSION["userId"] = $count["id"];
            $this -> db =null;
            exit();
           }
        } else {
            echo "password incorrect";
        }
       } else {
        echo "invalid email";
       }
       }
    }
?>