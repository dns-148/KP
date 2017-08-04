<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif_request extends CI_Controller {

  public function index()
  {
    $id_post = $this->session->userdata("id_karyawan");
    $data['notif_birthday'] = $this->Karyawan->showBirthdayRequest();
    $data['notif_event'] = $this->Kalender->showEventRequest();
    $data['notif_greeting'] = $this->Ucapan->showGreetingRequest($id_post);
    $data['id_ultah'] = $this->input->post('id_ultah');
    $this->load->view('home', $data);
  }

  public function countNotif() {
    $id_karyawan = $this->session->userdata("id_karyawan");
    $a = $this->Kalender->getComment($id_karyawan);
    $b = $this->Kalender->getEventRequest();
    echo $a+$b;
  }
}
