<?php
    class Categories {
        protected $connection;
        public function __construct($db)   {
            $this -> connection = $db;
        }
        public function addCategory($name){
            $addCat = $this -> connection -> prepare("INSERT INTO categories (name) VALUES (?)");
            $addCat -> execute([$name]);
        }
        public function showCategories(){
            $show = $this -> connection -> prepare("SELECT * from categories");
            $show -> execute();
            $showAsArr = $show -> fetchAll();
            return $showAsArr;
        }
        public function delCategory($catId){
            $delete = $this -> connection -> prepare("DELETE FROM categories where id = ?");
            $delete -> execute([(int)$catId]);
        }
        public function editCategory($catId, $catName){
            $delete = $this -> connection -> prepare("UPDATE categories set name = ? where id = ?");
            $delete -> execute([$catName, (int)$catId]);
        }
    // show specific category 
        public function showCat($id){
            $show = $this -> connection -> prepare("SELECT name from categories where id = $id");
             $show -> execute();
             $result = $show-> fetch(PDO::FETCH_ASSOC);
            return $result["name"];
        }
    }
?>