<?php

class Review_model extends CI_Model {

    public $star; # int 1~5
    public $message; # string
    public $isbn; # string
    public $user; # User

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($star, $message, $isbn, $user)
    {
        $this->star = $star;
        $this->message = $message;
        $this->isbn = $isbn;
        $this->user = $user;
    }
}

 ?>
