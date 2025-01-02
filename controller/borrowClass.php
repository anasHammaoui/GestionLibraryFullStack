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
            $return = $this-> connection -> prepare("UPDATE borrowings SET return_date = NOW(), book_status = 'Returned' WHERE id = $id");
            $return -> execute();
            $updateBook = $this -> connection -> prepare("SELECT book_id from borrowings where id  = ? ORDER BY id" );
            $updateBook -> execute([$id]) ;
            $bookId = $updateBook -> fetch(PDO::FETCH_ASSOC);
            $update = $this -> connection -> prepare("UPDATE books SET status = 'available' where id = ?");   
            $update -> execute([$bookId["book_id"]]) ;
        }  
        // reserve a book
        public function reserveBook($usId,$bkId,$dDate){
            $getLastDate = $this -> connection -> prepare("SELECT MAX(due_date) as lastDate FROM borrowings where book_id = :bookId");
            $getLastDate -> bindParam(":bookId",$bkId);
            $getLastDate -> execute();
            $result = $getLastDate -> fetch(PDO::FETCH_ASSOC);
            echo $result["lastDate"];
            // reserveBook 
            $reserveBook = $this -> connection -> prepare("INSERT INTO borrowings(user_id, book_id, borrow_date, due_date, book_status) VALUES (:us,:bk, :ls ,:due, 'Reserved') ");
            $reserveBook -> bindParam(":us",$usId);
            $reserveBook -> bindParam(":ls",$result["lastDate"]);
            $reserveBook -> bindParam(":bk",$bkId);
            $reserveBook -> bindParam(":due",$dDate);
            $reserveBook -> execute();
        }
        // borrow to reserved one
        public function borrowToReserved($bkId){
           $checkIfAvailable = $this -> connection -> prepare("SELECT status from books where id = ?");
           $checkIfAvailable -> execute([$bkId]);
           $getCheck = $checkIfAvailable -> fetch(PDO::FETCH_ASSOC);
            if ($getCheck["status"] == "available"){
                $getFirstReserved = $this ->connection -> prepare("UPDATE borrowings SET book_status  = 'Borrowed' WHERE book_status = 'Reserved' AND book_id = ? LIMIT 1");
                $getFirstReserved -> execute([$bkId]);
                $isExits = $getFirstReserved -> rowCount();
                // update book status if the reserved book get borrowed
                if ($isExits){
                    $updateBook = $this -> connection -> prepare("UPDATE books SET status = 'borrowed' where id = ?" );
                $updateBook -> execute([$bkId]);
                }
            // var_dump($isExits);
        }
          
            public function stat()
    {
        $countBorrow  = $this->connection->prepare("SELECT distinct count(*) as count_Borrow from borrowings");
        $countBorrow->execute();
        $count = $countBorrow->fetchAll(PDO::FETCH_ASSOC);
        return $count;
    }
    public function borrowedBy($bookId)
    {
        $countBorrow  = $this->connection->prepare("SELECT count(*) as count_Borrow from borrowings WHERE book_id = ?");
        $countBorrow->execute([$bookId]);
        $count = $countBorrow->fetch(PDO::FETCH_ASSOC);
        return $count["count_Borrow"];
    }
  
}
?>