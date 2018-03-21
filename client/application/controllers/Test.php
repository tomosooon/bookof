<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('chain_helper');
        $data['title'] = 'test';

        $models = loadChainData();

        // $data['book'] = $model['requests'];
        $data['models'] = $models;

        // $book->isbn = "isbnだよ！";
        $this->load->view('header.php',$data);
        $this->load->view('test/index',$data);

    }

}
