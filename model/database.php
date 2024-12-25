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
        
        $this -> connect =  new PDO("mysql:host={$this -> host};dbname={$this -> dbName}", $this -> user, $this -> pass);
         
        } catch (exception $e){
            echo $e;
        }
    }
    public function setConn(){
        return $this -> connect;
    }
 }
?>