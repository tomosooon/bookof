<?php

//TODO: BookMaterialからReviewを索引したい

class BookMaterial_model extends CI_Model {

    public $user; #User
    public $isbn; #string
    public $uuid; #string

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    public function init($isbn, $uuid)
    {
        $this->isbn = $isbn;
        $this->uuid = $uuid;
    }
}

 ?>
