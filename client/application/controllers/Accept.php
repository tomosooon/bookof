<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accept extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Accept List';

        $this->load->view('header.php', $data);
        $this->load->view('accept/index', $data);
    }

    public function detail()
    {
        $data['title'] = 'Accept';

        $this->load->view('header.php', $data);
        $this->load->view('accept/index', $data);

    }


}
