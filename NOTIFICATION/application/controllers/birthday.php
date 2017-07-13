<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class birthday extends CI_Controller{

  public function list_birthday()
  {
      $this->load->view('list_birthday');
  }
}