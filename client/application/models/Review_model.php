<?php

class Review_model extends CI_Model {

    public $book; # Book
    public $user; # User
    public $star; # int 1~5
    public $message; # string

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($book, $user, $star, $message)
    {
        $this->book = $book;
        $this->user = $user;
        $this->star = $star;
        $this->message = $message;
    }
}

 ?>
