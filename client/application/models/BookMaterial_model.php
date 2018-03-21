<?php

//TODO: BookMaterialからReviewを索引したい

class BookMaterial_model extends CI_Model {

    public $user; #User
    public $uuid; #string
    public $book; #Book

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($book, $uuid)
    {
        $this->book = $book;
        $this->uuid = $uuid;
    }
}

 ?>
