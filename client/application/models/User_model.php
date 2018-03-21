<?php

//TODO: Accept画面では持っている本へのリクエストをみたい。 ⇒ User ⇒ BookMaterial.isbn ⇒ Requests

class User_model extends CI_Model {

    public $email; # string
    public $bookMaterials; # [BookMaterial]
    public $requests; # [Request]

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($email)
    {
        $this->email = $email;
        $this->bookMaterials = array();
        $this->requests = array();
    }
}

 ?>
