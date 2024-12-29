<?php
    class Borrow {
        protected $connection;
        public function __construct($db){
            $this -> connection = $db;
        }
        public function borrow($usId, $bkId,$bDate,$dDate, $rDate){
            $borrow = $this -> connection -> prepare("INSERT INTO borrowings(user_id, book_id, borrow_date, due_date, return_date) VALUES (?,?,?,?,?) ");
            $borrow -> execute([$usId,$bkId,$bDate,$dDate,$rDate]);
        }
    }
?>