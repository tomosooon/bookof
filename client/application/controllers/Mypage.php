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
    $email = $this->input->get_post('email');
    $data['title'] = 'home';
    $request = new RequestMock(NULL, NULL, date("Y/m/d"), date("Y/m/d"));
    $review = new ReviewMock(1, "めっちゃいいです", "1111-1111-1111", NULL, date("Y/m/d"));
    $book = new BookMock("1111-1111-1111", [$review], [$request]);
    $bookMaterial = new BookMaterialMock("123456", NULL, $book);
    $user = new UserMock("test.com", [$bookMaterial]);
    $data['user'] = $user;
    $this->load->model('User_model');
	  $this->load->view('header.php', $data);
    $this->load->view('mypage/index', $data);
  }
}

class UserMock {

  public $email; # string
  public $bookMaterials; # [BookMaterial]

  public function __construct($email, $bookMaterials)
  {
    $this->email = $email;
    $this->bookMaterials = $bookMaterials;
  }
}

class BookMaterialMock {
  
  public $user; #User
  public $uuid; #string
  public $book; #Book

  public function __construct($uuid, $user, $book)
  {
    $this->uuid = $uuid;
    $this->user = $user;
    $this->book = $book;
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

class BookMock {
  public $isbn; #string
  public $reviews; # [Review]
  public $requests; # [Request]

  public function __construct($isbn, $reviews, $requests)
  {
    $this->isbn = $isbn;
    $this->reviews = $reviews;
    $this->requests = $requests;
  }
}

class RequestMock {

  public $book; # Book
  public $user; # User
  public $fromWhen; # Date
  public $createdAt; # DateTime

  public function __construct($book, $user, $fromWhen, $createdAt)
  {
    $this->book = $book;
    $this->user = $user;
    $this->fromWhen = $fromWhen;
    $this->createdAt = $createdAt;
  }
  
}
?>
