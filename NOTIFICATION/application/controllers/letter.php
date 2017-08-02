<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class letter extends CI_Controller{

  public function letter_request()
  {
      $this->load->view('surat1.html');
  }
    public function letter_request2()
  {
      $this->load->view('surat2.html');
  }
    public function letter_request3()
  {
      $this->load->view('surat3.html');
  }
}