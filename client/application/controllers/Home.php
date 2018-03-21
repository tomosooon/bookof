<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['email'])) {
            $data['title'] = 'login';
            $email = $this->input->post('email') != '' ? $this->input->post('email') : '';
            $send = $this->input->post('send') != '' ? $this->input->post('send') : '';
            if ($send != '') {
                $_SESSION['email'] = $email;
                $url = "http://".base_url()."home";
                header("Location: {$url}");
                exit();

            }
            $this->load->view('header.php',$data);
            $this->load->view('login/index',$data);
        }

    }

    public function index()
    {
      $this->load->helper('chain_helper');
      $models = loadChainData();

      $data['books'] = $models['books'];

	    $data['title'] = 'home';
	    $this->load->view('header.php',$data);
		  $this->load->view('home/index',$data);
	  }
}
