<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accept extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $email = $this->input->get_post('email');
        $this->load->helper('chain_helper');
        $data['title'] = 'Accept List';
        $models = loadChainData();
        # emailに該当するユーザーのindex検索
        $userIndex = array_search($email, array_map(function($value) {
          return $value->email;
        }, $models['users']));
        $user = $models['users'][$userIndex];
        $data['requests'] = $user->requests;
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
