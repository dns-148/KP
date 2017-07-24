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
	 	$result = $this->db_user->login($email, $password);
	 	if($result){
	 		$sess_array = array();

			foreach($result as $row){
				$sess_array = array(
					'id' => $row->ID,
					'nama' => $row->Nama,
					'profilepict' => $row->ProfilePict,
					'room' => -1
				);
		    	$this->session->set_userdata('logged_in', $sess_array);
	    	}
    		return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
}
?>
