<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('url');
        //$this->load->library('session');
    }

    public function index()
    {
        $this->load->helper('url');

        $data['title'] = 'login';
        $email = $this->input->post('email') != '' ? $this->input->post('email') : '';
        $send = $this->input->post('send') != '' ? $this->input->post('send') : '';
        if ($send != '') {
            $_SESSION['email'] = $email;
            echo $_SESSION['email'];


        }

        $this->load->view('header.php',$data);
        $this->load->view('login/index',$data);
    }
}
