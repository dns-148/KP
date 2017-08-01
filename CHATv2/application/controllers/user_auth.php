<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_auth extends CI_Controller {

	public function index(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		$username = $this->input->post('email');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('login_page');
		}
		else
		{
			redirect('Welcome', 'refresh');
		}
	}

	function check_database($password){
	 	$email = $this->input->post('email');
	 	$timezone = $this->input->post('timezone');
	 	$result = $this->db_user->login($email, $password);
	 	if($result){
	 		$sess_array = array();

			$sess_array = array(
				'id' => $result[0]['ID'],
				'nama' => $result[0]['Nama'],
				'profilepict' => $result[0]['ProfilePict'],
				'room' => -2,
				'timezone' => $timezone
			);
		    $this->session->set_userdata('logged_in', $sess_array);

    		return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
}
?>
