<?php

class User_model extends CI_Model {

        public $email; # string
        public $reviews; # [Review]
        public $bookMaterials; # [BookMaterial]

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