<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
	    $data['title'] = 'home';

	    $this->load->view('header.html',$data);
		$this->load->view('home/index',$data);
	}

	public function detail()
    {
        $data['title'] = 'detail';
        $uuid = $this->input->get_post('uuid');
        $this->load->view('header.html',$data);
        $this->load->view('home/detail',$data);
    }
}
