<?php
    class Borrow {
        protected $connection;
        public function __construct($db){
            $this -> connection = $db;
        }
        // borrow a book
        public function borrow($usId, $bkId,$bDate,$dDate){
            $borrow = $this -> connection -> prepare("INSERT INTO borrowings(user_id, book_id, borrow_date, due_date, book_status) VALUES (?,?,?,?, 'Borrowed') ");
            $borrow -> execute([$usId,$bkId,$bDate,$dDate]);
            $updateBook = $this -> connection -> prepare("UPDATE books SET status = 'borrowed' where id = ?" );
            $updateBook -> execute([$bkId]);
        }
        // show borrowed books
        public function showBorrowed($usId){
            $show  = $this -> connection -> prepare("SELECT * FROM borrowings where user_id = $usId");
            $show -> execute();
            $result = $show -> fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        // return a book
        public function returnBook($id){
            $del = $this-> connection -> prepare("UPDATE borrowings SET return_date = NOW() WHERE id = $id");
            $del -> execute();
            $updateBook = $this -> connection -> prepare("SELECT book_id from borrowings where id = ?" );
            $updateBook -> execute([$id]) ;
            $bookId = $updateBook -> fetchAll(PDO::FETCH_ASSOC);
            $update = $this -> connection -> prepare("UPDATE books SET status = 'available' where id = ?");   
            $update -> execute([$bookId[0]["book_id"]]) ;
        }  
        // reserve a book
        public function reserveBook($usId,$bkId,$dDate){
            $getLastDate = $this -> connection -> prepare("SELECT MAX(due_date) as lastDate FROM borrowings where book_id = :bookId");
            $getLastDate -> bindParam(":bookId",$bkId);
            $getLastDate -> execute();
            $result = $getLastDate -> fetch(PDO::FETCH_ASSOC);
            echo $result["lastDate"];
            // reserveBook 
            $reserveBook = $this -> connection -> prepare("INSERT INTO borrowings(user_id, book_id, borrow_date, due_date, book_status) VALUES (:us,:bk, DATE_ADD(:ls, INTERVAL 1 DAY) ,:due, 'Reserved') ");
            $reserveBook -> bindParam(":us",$usId);
            $reserveBook -> bindParam(":ls",$result["lastDate"]);
            $reserveBook -> bindParam(":bk",$bkId);
            $reserveBook -> bindParam(":due",$dDate);
            $reserveBook -> execute();
        }
    }
?>