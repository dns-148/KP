<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class birthday extends CI_Controller{

  public function load_birthday()
  {
    $id_post = $this->session->userdata("id_karyawan");
    $id_karyawan = $this->input->get('id', TRUE);
    $data['notif_birthday'] =$this->Karyawan->showBirthdayRequest();
    $data['notif_event'] =$this->Kalender->showEventRequest();
    $data['notif_greeting']=$this->Ucapan->showGreetingRequest($id_post);
    $data['get_id'] = $this->Karyawan->get_id($id_karyawan);
    $data['list_ucapan'] = $this->Ucapan->showGreeting($id_karyawan);
    $data['id_beneran'] = $id_karyawan;
    $this->load->view('birthday_greetings', $data);
  }

  public function add_greeting() {
   $id_post = $this->session->userdata("id_karyawan");
   $ucapan = $this->input->post('isi_ucapan');
   $id_ultah = $this->input->post('id_ultah');
   $data = $this->Ucapan->insert_greeting($ucapan, $id_post, $id_ultah);
   $id_karyawan = $this->input->post('created_by');
   $url = 'birthday/show_greeting?id=' . $id_karyawan;
   redirect($url);
  }

  public function show_greeting() {
    $id_post = $this->session->userdata("id_karyawan");
    $data['notif_birthday'] =$this->Karyawan->showBirthdayRequest();
    $data['notif_event'] =$this->Kalender->showEventRequest();
    $data['notif_greeting']=$this->Ucapan->showGreetingRequest($id_post);
    $id_karyawan = $this->input->get('id', TRUE);
    $data['get_id'] = $this->Karyawan->get_id($id_karyawan);
    $data['list_ucapan'] = $this->Ucapan->showGreeting($id_karyawan);
    $data['id_beneran'] = $id_karyawan;
    $this->load->view('list_greeting',$data);
  }
}
