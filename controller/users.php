<?php
session_start();
    class Users {
        protected $email;
        protected $password;
        protected $db;
        // login function
       public function login($db,$email, $pass){
         //    VALIDATE data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        // give data
        $this -> email = validate($email);
        $this -> password = validate($pass);
        $this -> db = $db;
        // start login
        $email = $this -> email;
        $checkEmail = $this -> db -> prepare("SELECT email, password, role,id FROM users WHERE email = :email");
       $checkEmail -> bindParam(":email",$email);
       $checkEmail -> execute();
       $count = $checkEmail -> fetch(PDO::FETCH_ASSOC);
       if ($count){
        if (password_verify($pass, $count["password"])){
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