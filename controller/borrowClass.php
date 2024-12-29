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
        public function showBorrowed($usId){
            $show  = $this -> connection -> prepare("SELECT * FROM borrowings where user_id = $usId");
            $show -> execute();
            $result = $show -> fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function returnBook($id){
            $del = $this-> connection -> prepare("DELETE FROM borrowings WHERE id = $id");
            $del -> execute();
        }
    }
?>