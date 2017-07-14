<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class letter extends CI_Controller{

  public function letter_request()
  {
      $this->load->view('surat1.html');
  }
}