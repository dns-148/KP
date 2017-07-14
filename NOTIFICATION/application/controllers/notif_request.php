<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif_request extends CI_Controller {

  public function index()
  {
    $data['notifikasi'] =$this->Karyawan->showBirthdayRequest();
    $this->load->view('home', $data);
  }

  public function countBirthday() {
    $data = $this->Karyawan->getBirthdayRequest();
    echo $data;
  }

  public function load_birthday() {
    $data = $this->Karyawan->showBirthdayRequest();
    $no = 0;
    foreach($data as $rdata){
      $no++;
      if($no % 2 == 0) {
        $strip = 'strip1';
      }
      else {
        $strip = 'strip2';
      }
    }
  }
}
