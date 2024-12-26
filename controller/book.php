<?php
    class Books{
        protected $bookname;
        protected $bookCategory;
        protected $author;
        protected $status;
        protected $createdAt;
        protected $connection;
        public function __construct($db){
            $this -> connection = $db;
        }
        public function show(){
            $show = $this -> connection -> prepare("SELECT * from books");
            $show -> execute();
            $showAsArr = $show -> fetchAll();
            return $showAsArr;
        }
        public function edit($name,$cat,$auth,$status, $id,$summ){
            $edit = $this -> connection -> prepare("UPDATE books SET title = ? , category_id = ? , author = ? , status = ?, summary = ? WHERE id = ?");
            $edit -> execute([$name , (int)$cat, $auth, $status, $summ, (int)$id]);
        }
    }
?>