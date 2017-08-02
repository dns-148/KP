<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		//$name = $this->input->post('nama');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$cek = $this->Karyawan->get_data($email, $password);
		if($cek) {

			$data_session = array(
				'email' => $email,
				'nama' => $cek[0]->nama,
				'id_karyawan' => $cek[0]->id_karyawan,
				'status' => "login"
			);

			$this->session->set_userdata($data_session);

			redirect(base_url('notif_request'));
		}
		else{
			echo "<script>
				alert('Email or password is incorrect');
				window.location.href='index';
				</script>";
		}

		$this->load->view('login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('user_login'),'refresh');
	}
}
