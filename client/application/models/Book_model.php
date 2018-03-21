<?php

class Book_model extends CI_Model {

    public $isbn; #string
    public $name; #string
    public $authors; # [string]
    public $manufacturer; #string
    public $imageURL; #string
    public $reviews; # [Review]
    public $requests; # [Request]
    public $bookMaterials; # [BookMaterial]

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($isbn, $name)
    {
        $this->isbn = $isbn;
        $this->name = $name;
        $this->authors = array();
        $this->manufacturer = '';
        $this->imageURL = '';
        $this->reviews = array();
        $this->requests = array();
        $this->bookMaterials = array();
    }
}

 ?>
