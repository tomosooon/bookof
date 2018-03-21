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

        $book = new Book_model();
        $book->init("isbnだよ！");

        // $book->isbn = "isbnだよ！";
        $data['book'] = $book;

        $this->load->view('header.php',$data);
        $this->load->view('test/index',$data);
    }

}
