<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
  public function index()
  {
    $data['title'] = 'detail';
    $uuid = $this->input->get_post('uuid');
    $this->load->view('header.php',$data);
    $this->load->view('detail/index',$data);
	}


}
