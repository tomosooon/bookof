<?php

//TODO: BookMaterialからReviewを索引したい

class BookMaterial_model extends CI_Model {

    public $user; #User
    public $bookMaterialId; #string
    public $book; #Book

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($book, $bookMaterialId)
    {
        $this->book = $book;
        $this->bookMaterialId = $bookMaterialId;
    }
}

 ?>
