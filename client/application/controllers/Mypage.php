<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  public function index()
  {
    date_default_timezone_set('Asia/Tokyo');
    $data['title'] = 'home';
    $reviews = new ReviewMock(1, "めっちゃいいです", "1111-1111-1111", NULL, date("Y/m/d"));
    $bookMaterial = new BookMaterialMock(NULL, "1111-1111-1111", "123456");
    $user = new UserMock("test.com", [$reviews], [$bookMaterial]);
    $data['user'] = $user;
    $this->load->model('User_model');
	  $this->load->view('header.php', $data);
    $this->load->view('mypage/index', $data);
  }
}

class UserMock {

  public $email; # string
  public $reviews; # [Review]
  public $bookMaterials; # [BookMaterial]

  public function __construct($email, $reviews, $bookMaterials)
  {
    $this->email = $email;
    $this->reviews = $reviews;
    $this->bookMaterials = $bookMaterials;
  }
}

class BookMaterialMock {
  
  public $user; #User
  public $isbn; #string
  public $uuid; #string

  public function __construct($user, $isbn, $uuid)
  {
    $this->user = $user;
    $this->isbn = $isbn;
    $this->uuid = $uuid;
  }
}

class ReviewMock {
  public $star; # int 1~5
  public $message; # string
  public $isbn; # string
  public $user; # User
  public $createdAt; # Date

  public function __construct($star, $message, $isbn, $user, $createdAt)
  {
    $this->star = $star;
    $this->message = $message;
    $this->isbn = $isbn;
    $this->user = $user;
    $this->createdAt = $createdAt;
  }
}

?>
