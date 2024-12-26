<?php
 class DataBase {
    private  $host;
    private  $dbName;
    private $user;
    private $pass;
    private $connect;
    public function __construct($host,$dbName, $user, $pass){
        $this -> host = $host;
        $this -> dbName = $dbName;
        $this -> user = $user;
        $this -> pass = $pass;
    }
    public function conn(){
        try {
        $hostname = $this -> host;
        $dbNamePdo = $this -> dbName;
        $dbUserName = $this -> user;
        $passDb = $this -> pass;
        $this -> connect =  new PDO("mysql:host={$hostname};dbname={$dbNamePdo}",$dbUserName , $passDb );
         
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function setConn(){
        return $this -> connect;
    }
 }

 

?>