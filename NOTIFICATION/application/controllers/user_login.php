<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$where = array(
			'email' => $email,
			'password' => $password
			);
		$cek = $this->Karyawan->cek_karyawan("karyawan",$where)->num_rows();
		if($cek > 0){

			$data_session = array(
				'email' => $email,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url('notif_request'));

		}
		else{
			echo "Email or password is incorrect!";
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('user_login'));
	}
}
