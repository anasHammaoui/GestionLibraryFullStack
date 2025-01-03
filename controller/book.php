<?php
    class Books{
        protected $connection;
        public function __construct($db){
            $this -> connection = $db;
        }
        // show all books
        public function show(){
            $show = $this -> connection -> prepare("SELECT * from books");
            $show -> execute();
            $showAsArr = $show -> fetchAll();
            return $showAsArr;
        }
        // edit existing book
        public function edit($name,$cat,$auth,$status, $id,$summ, $cover){
            $edit = $this -> connection -> prepare("UPDATE books SET title = ? , category_id = ? , author = ? , status = ?, summary = ?, cover_image = ? WHERE id = ?");
            $edit -> execute([$name , (int)$cat, $auth, $status, $summ,$cover, (int)$id ]);
        }
        // add a book
        public function add($title, $author, $category,$cover,$summary){
            $add = $this-> connection -> prepare("INSERT INTO books (title,author,category_id,cover_image,summary) VALUES (?, ?, ?, ?, ?)");
            $add -> execute([$title,$author,(int)$category,$cover,$summary]);
        }
        // delete book
        public function delete($id){
            $delete = $this -> connection -> prepare("DELETE FROM books where id = ?;");
            $delete -> execute([(int)$id]);
        }
        // search book
        public function search($sr){
            $search = $this -> connection -> prepare("SELECT * FROM books WHERE title like '%{$sr}%'");
            $search -> execute();
            $result = $search -> fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);
        }   
        public function statistique()
        {
            $countB  = $this->connection->prepare("SELECT count(*) as count_books from books");
            $countB->execute();
            $count = $countB->fetchAll(PDO::FETCH_ASSOC);
            return $count;
        }
    }
?>