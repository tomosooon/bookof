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
    $email = $this->input->get_post('email');

    $this->load->helper('chain_helper');
    $this->load->helper('amazon_api_helper');
    $models = loadChainData();

    $data['title'] = 'mypage';

    # emailに該当するユーザーのindex検索
    $userIndex = array_search($email, array_map(function($value) {
      return $value->email;
    }, $models['users']));
    $user = $models['users'][$userIndex];

    for($i = 0; $i < count($user->bookMaterials); $i++) {
      $isbn = $user->bookMaterials[$i]->book->isbn;
      $book = loadBookInformation($isbn);
      $user->bookMaterials[$i]->book = $book;
    }
    $data['user'] = $user;
    $this->load->model('User_model');
	  $this->load->view('header.php', $data);
    $this->load->view('mypage/index', $data);
  }
}

?>
