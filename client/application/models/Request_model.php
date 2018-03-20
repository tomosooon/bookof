<?php

class Request_model extends CI_Model {

        public $book; # Book
        public $user; # User
        public $fromWhen; # Date
        public $createdAt; # DateTime

        public function __construct()
        {
                // CI_Model constructor の呼び出し
                parent::__construct();
        }

        public function init($email)
        {
          $this->email = $email;
        }
}

 ?>
