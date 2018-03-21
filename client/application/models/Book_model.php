<?php

class Book_model extends CI_Model {

    public $isbn; #string
    public $reviews; # [Review]
    public $requests; # [Request]
    public $bookMaterials; # [BookMaterial]

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($isbn)
    {
        $this->isbn = $isbn;
    }
}

 ?>
