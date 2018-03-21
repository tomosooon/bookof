<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('Chain_helper');
        $data['title'] = 'test';

        $book = new Book_model();
        $book->init("isbnだよ！");



        $data['book'] = loadChainData();;

        // $book->isbn = "isbnだよ！";
        $this->load->view('header.html',$data);
        $this->load->view('test/index',$data);

    }

}
