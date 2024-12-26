<?php
include "database.php";
$database = new Database("localhost", "library", "root", "");
$database->conn();
$connection = $database->setConn();
var_dump($connection);

class Users
{
    protected $username;
    protected $email;
    protected $password;
    protected $confirmPassword;
    protected $db;


    public function SignUp($username, $email, $password, $confirmPassword, $db)
    {
        // full data
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->db = $db;
        $hashed = password_hash($password, PASSWORD_DEFAULT);


        if ($this->password !== $this->confirmPassword) {
            echo "Les mots de passe ne correspondent pas.";
            exit;
        }
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo "Tous les champs sont obligatoires.";
            exit;
        } else {
            try {
                $query1 = "SELECT count(*) FROM users";
                $result = $this->db->query($query1)->fetchColumn();
                $role = $result == 0 ? "admin" : "authenticated";

                $stmt = $this->db->prepare("INSERT INTO users (NAME,email, password,role) VALUES (?,?,?,?)");
                $stmt->execute([$this->username, $this->email, $hashed, $role]);
                echo "inscription reussite";
                header("location: login.php");
            } catch (PDOException $e) {
                echo "Erreur  : " . $e->getMessage();
            }
        }
    }
}
