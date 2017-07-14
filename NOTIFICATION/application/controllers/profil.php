<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil extends CI_Controller{

  public function index()
  {
    $this->load->view('edit_profile');
  }

  public function edit_profile(){
    $id_karyawan =$this->uri->segment(3);
    $data['tangkap'] = $this->Karyawan->get_id($id_karyawan)->row_array();
    //$data['listdivisi'] = $this->Divisi->list_divisi();
    $this->load->view('edit_profile', $data);
  }

  public function save_profile(){
    $id_karyawan = $this->input->post('id_karyawan');
		$karyawan = array(
		 	'nama' => $this->input->post('nama'),
		 	'alamat' => $this->input->post('alamat'),
      'email' => $this->input->post('email'),
      'no_telp' => $this->input->post('no_telp'),
      'divisi' => $this->input->post('divisi'),
      'password' => $this->input->post('password'));
		$this->db->where('id_karyawan',$id_karyawan);
		$this->db->update('karyawan', $karyawan);
		redirect('notif_request');
  }
}
