<?php
    class Borrow {
        protected $connection;
        public function __construct($db){
            $this -> connection = $db;
        }
        public function borrow($usId, $bkId,$bDate,$dDate){
            $borrow = $this -> connection -> prepare("INSERT INTO borrowings(user_id, book_id, borrow_date, due_date) VALUES (?,?,?,?) ");
            $borrow -> execute([$usId,$bkId,$bDate,$dDate]);
            $updateBook = $this -> connection -> prepare("UPDATE books SET status = 'borrowed' where id = ?" );
            $updateBook -> execute([$bkId]);
        }
        public function showBorrowed($usId){
            $show  = $this -> connection -> prepare("SELECT * FROM borrowings where user_id = $usId");
            $show -> execute();
            $result = $show -> fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        public function returnBook($id){
            $del = $this-> connection -> prepare("UPDATE borrowings SET return_date = NOW() WHERE id = $id");
            $del -> execute();
            $updateBook = $this -> connection -> prepare("SELECT book_id from borrowings where id = ?" );
            $updateBook -> execute([$id]) ;
            $bookId = $updateBook -> fetchAll(PDO::FETCH_ASSOC);
            $update = $this -> connection -> prepare("UPDATE books SET status = 'available' where id = ?");   
            $update -> execute([$bookId[0]["book_id"]]) ;
        }
    }
?>