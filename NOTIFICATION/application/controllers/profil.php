<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil extends CI_Controller{

  public function edit_profile()
  {
      $this->load->view('edit_profile');
  }
}