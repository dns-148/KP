<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('db_user','',TRUE);
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		$username = $this->input->post('username');
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
	 	$username = $this->input->post('username');
	 	$result = $this->db_user->login($username, $password);
	 	if($result){
	 		$sess_array = array();

			foreach($result as $row){
				$sess_array = array(
					'id' => $row->ID,
					'username' => $row->Username,
					'nama' => $row->Nama,
					'room' => 1
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
