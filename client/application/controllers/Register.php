<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
	{
	    $data['title'] = 'register';
	    $sender = $this->input->post('sender') != '' ? $this->input->post('sender'):"";
        $isbn = $this->input->post('isbn') != '' ? $this->input->post('isbn'):"";
        $from_date = $this->input->post('from_date') != '' ? $this->input->post('from_date'):"";
        $send = $this->input->post('send') != '' ? $this->input->post('send'):"";
        if ($send != "") {
//            echo "send true";
              var_dump($send);
              $url = "http://localhost:5000/";

              var_dump($url);

        }
        $this->load->view('header.php',$data);
		$this->load->view('register/index',$data);
	}
}
