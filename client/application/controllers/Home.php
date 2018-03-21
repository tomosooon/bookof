<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
	{
	    $data['title'] = 'home';
	    $this->load->view('header.php',$data);
		$this->load->view('home/index',$data);
	}
}
