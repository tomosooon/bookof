<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
	{
	    $data['title'] = 'register';
	    $sender = $this->input->post('sender') != '' ? $this->input->post('sender'):"";
        $isbn = $this->input->post('isbn') != '' ? $this->input->post('isbn'):"";
        $from_date = $this->input->post('from_date') != '' ? $this->input->post('from_date'):"";
        $send = $this->input->post('send') != '' ? $this->input->post('send'):"";
        if ($send != "") {

            $uuid = uniqid(rand());


            $params = array(
                "sender" => $sender,
                "name" => $isbn,
                "isbn" => $isbn,
                "uuid" => $uuid
            );
            $params = json_encode($params);

            $ops = array(
                'http' => array(
                    'method' => 'POST',
                    'context' => '{"sender":"eee","name":"dsss","isbn":"dsss","uuid":"20606212135ab1ec9ce087b"}',
                    'header' => "Content-Type: application/json"
                ),
            );
            $ctx = stream_context_create($ops);
            var_dump($params);
            var_dump($ctx);
            $content = file_get_contents('http://localhost:5000/register',false,$ctx);
            //$fp = fopen('http://localhost:5000/register','r',false,$ctx);
            //fpassthru($fp);
            //fclose($fp);
            //var_dump($content);

        }
        $this->load->view('header.php',$data);
		$this->load->view('register/index',$data);
	}
}
