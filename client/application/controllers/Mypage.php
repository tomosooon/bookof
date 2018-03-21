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

    $this->load->helper('Chain_helper');
    $models = loadChainData();

    $data['title'] = 'mypage';

    # emailに該当するユーザーのindex検索
    $userIndex = array_search($email, array_map(function($value) {
      return $value->email;
    }, $models['users']));
    $user = $models['users'][$userIndex];

    $data['user'] = $user;
    $this->load->model('User_model');
	  $this->load->view('header.php', $data);
    $this->load->view('mypage/index', $data);
  }
}

?>
