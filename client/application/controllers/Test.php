<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'test';

        $this->load->view('header.php',$data);
        $this->load->view('test/index',$data);
    }

}
