<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif_request extends CI_Controller {

  public function index()
	{
		$this->load->view('home');
	}

  public function countBirthday() {
        $data = $this->Karyawan->getBirthdayRequest();
        echo $data;
        
       // $this->load->view('home');
    }
}
