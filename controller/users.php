<?php
class Users
{
    protected $username;
    protected $email;
    protected $password;
    protected $confirmPassword;
    protected $db;
    protected $connection;


    // sign up
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
                header("location: loginpage.php");
            } catch (PDOException $e) {
                echo "Erreur  : " . $e->getMessage();
            }
        }
    }
    // login function
    public function login($db, $email, $pass)
    {
        //    VALIDATE data
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        // give data
        $this->email = validate($email);
        $this->password = validate($pass);
        $this->db = $db;
        // start login
        $email = $this->email;
        $checkEmail = $this->db->prepare("SELECT email, password, role,id FROM users WHERE email = :email");
        $checkEmail->bindParam(":email", $email);
        $checkEmail->execute();
        $count = $checkEmail->fetch(PDO::FETCH_ASSOC);
        if ($count) {
            if (password_verify($pass, $count["password"])) {
                if ($count["role"] === "authenticated") {
                    header("location: userDash.php");
                    $_SESSION["userRole"] = "authenticated";
                    $_SESSION["userId"] = $count["id"];
                    $this->db = null;
                    exit();
                } elseif ($count["role"] === "admin") {
                    header("location: adminDash.php");
                    $_SESSION["userRole"] = "admin";
                    $_SESSION["userId"] = $count["id"];
                    $this->db = null;
                    exit();
                }
            } else {
                echo "password incorrect";
            }
        } else {
            echo "invalid email";
        }
    }
    public  function __construct($db) {
        $this->connection = $db;
    }
    public function showUsers() {
        $showUsers = $this->connection->prepare("SELECT * from users");
        $showUsers->execute();
        $showAsArr = $showUsers->fetchAll();
        return $showAsArr;
    }
    // public  function __destruct( $db)
    // {
    //     $this->connection = $db;
    // }

    public function edit($id, $role){
        $edit = $this -> connection -> prepare("UPDATE users SET  role = ? WHERE id = ?");
        $edit -> execute([$role,(int)$id ]);
    }
    public function delete($id){
        $delete = $this -> connection -> prepare("DELETE FROM users where id = ?");
        $delete -> execute([(int)$id]);
    }
    // public function statistiques($connect){
    // $totalUsers = $connect->query("SELECT COUNT(*)  FROM users")->fetchColumn();
    // }
}
