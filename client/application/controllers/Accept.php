<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accept extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function accept()
    {
        $data['title'] = 'Accept';

        $this->load->view('header.html',$data);
        $this->load->view('home/index',$data);
    }
}
