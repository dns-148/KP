<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			$prev_id = $this->input->get('room', TRUE);
			$session_data = $this->session->userdata('logged_in');
     		$data['username'] = $session_data['username'];
     		$data['nama'] = $session_data['nama'];
     		$data['id'] = $session_data['id'];
     		$data['profilepict'] = $session_data['profilepict'];
     		$data['friend'] = $this->list_friend($data['id']);

     		$list_room = $this->db_user->roomParticipate($data['id']);
     		
     		if($list_room){
     			$roomdatas = array();
     			foreach ($list_room as $room) {
     				$roomdata = $this->db_room->info($room->idChatRoom);
     				array_push($roomdatas, $roomdata);
     			}

     			if($prev_id != NULL){
     				$data['room'] = $prev_id;
	     			$session_data['room'] = $prev_id;

	     			$this->session->set_userdata('logged_in', $session_data);
     			}else if($session_data['room'] > -1){
     				$data['room'] = $session_data['room'];
     			}else{
     				$data['room'] = $list_room[0]->idChatRoom;
     				$session_data['room'] = $data['room'];

     				$this->session->set_userdata('logged_in', $session_data);
     			}

     			$data['list_room'] = $roomdatas;
     		}else{
     			$data['room'] = -1;
     			$data['list_room'] = NULL;
     		}

     		if($data['room'] > -1){
     			$nama_room = 'public.Room' . $data['room'];
     			$data['list_chat'] = $this->db_chat->fetchAll($nama_room);
     		}else{
     			$data['list_chat'] = false;
     		}

     		$this->load->view('chat_2', $data);
		}else{
			redirect('login', 'refresh');
		}
	}

	public function list_friend($id)
	{
		$result = $this->db_user->friendList($id);
		if($result){
	 		$data = array();

			foreach($result as $row){
				if($row->idUser1 == $id){
					$friend_id = $row->idUser2;
				}else{
					$friend_id = $row->idUser1;
				}
				$raw_friend_data = $this->db_user->userData($friend_id);
				
				if($raw_friend_data){
					foreach($raw_friend_data as $row){
						$friend_data = array(
							'id' => $row->ID,
							'nama' => $row->Nama,
							'profilepict' => $row->ProfilePict,
						);
						array_push($data, $friend_data);
			    	}
				}
	    	}
    		return $data;
		}else{
			return false;
		}
	}
}