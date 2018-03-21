<?php

class Request_model extends CI_Model {

    public $book; # Book
    public $user; # User
    public $fromDate; # Date
    public $requestId; # string
    public $isAccepted; # boolean

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($book, $user, $fromDate, $requestId)
    {
        $this->book = $book;
        $this->user = $user;
        $this->fromDate = $fromDate;
        $this->requestId = $requestId;
        $this->isAccepted = false;
    }
}

 ?>
