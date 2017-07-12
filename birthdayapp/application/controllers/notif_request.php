<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif_request extends CI_Controller {

  public function index()
	{
		$this->load->view('home');
	}

  public function countBirthday() {
        $data = $this->User->getBirthdayRequest();
        //echo $data;

        foreach ($data as $row) {
            $a = $row->count;
            echo $a;
        }
        $this->load->view('home');
    }
}
