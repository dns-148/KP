<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif_request extends CI_Controller {

  public function index()
  {
    $data['notif_birthday'] = $this->Karyawan->showBirthdayRequest();
    $data['notif_event'] = $this->Kalender->showEventRequest();
    $data['notif_greeting'] = $this->Ucapan->showGreetingRequest();
    $this->load->view('home', $data);
  }

  public function countNotif() {
    $data = $this->Kalender->getEventRequest();
    echo $data;
  }
}
