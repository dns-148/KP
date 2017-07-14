<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends CI_Controller {

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
	public function index()
	{
		if($this->session->userdata('logged_in')){
			$prev_id = $this->uri->segment(3);
			$session_data = $this->session->userdata('logged_in');
     		$data['username'] = $session_data['username'];
     		$data['nama'] = $session_data['nama'];
     		if($prev_id != NULL){
     			$data['room'] = $prev_id;
     		}else{
     			$data['room'] = $session_data['room'];
     		} 
     		$this->load->view('chat', $data);
		}else{
			redirect('login', 'refresh');
		}
	}
}