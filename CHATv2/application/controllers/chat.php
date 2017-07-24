<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			$prev_id = $this->input->get('room', TRUE);
			$session_data = $this->session->userdata('logged_in');
     		$data['nama'] = $session_data['nama'];
     		$data['id'] = $session_data['id'];
     		$data['profilepict'] = $session_data['profilepict'];
     		$data['friend'] = $this->listing_friend($data['id']);
     		
     		if($prev_id != NULL){
     			$data['unread'] = ($this->db_user->getUnread($prev_id, $data['id']))[0]['countUnread'];
     			$this->db_user->updateUnread($prev_id, $data['id'], 0);
     		}else{
     			$data['unread'] = -1;
     		}

     		$list_room = $this->db_user->roomParticipate($data['id']);
     		
     		if($list_room){
     			if($prev_id != NULL){
     				$data['room'] = $prev_id;
	     			$session_data['room'] = $prev_id;

	     			$this->session->set_userdata('logged_in', $session_data);
	     			$date_join = $this->db_user->fetchDateJoin($data['room'], $data['id']);
	     			$data['room_info'] = $this->db_room->info($data['room'], 0, $date_join);
     			}else if($session_data['room'] > -1){
     				$data['room'] = $session_data['room'];
     				$date_join = $this->db_user->fetchDateJoin($data['room'], $data['id']);
	     			$data['room_info'] = $this->db_room->info($data['room'], 0, $date_join);
     			}else{
     				$data['room'] = -1;
     				$session_data['room'] = -1;
     				$data['room_info'] = NULL;

     				$this->session->set_userdata('logged_in', $session_data);
     			}

     			$list_room = $this->get_roomdata($list_room);
     			$data['allroom_info'] = $this->get_lastchat($list_room);
     			usort($data['allroom_info'], array($this,'cmp_inv_time'));
     		}else{
     			$data['room'] = -1;
     			$data['allroom_info'] = NULL;
     			$data['room_info'] = NULL;
     			$data['last_chat'] = NULL;
     		}

     		if($data['room'] > -1){
     			$nama_room = 'public.Room' . $data['room'];
     			$date_join = $this->db_user->fetchDateJoin($data['room'], $data['id']);
     			$data['list_chat'] = $this->db_chat->fetchAll($nama_room, $date_join[0]['dateJoin']);
     			$data['user_participate'] = $this->db_room->allUserParticipate($data['room']);
     		}else{
     			$data['list_chat'] = false;
     			$data['user_participate'] = false;
     		}

     		$this->load->view('chat_2', $data);
		}else{
			redirect('login', 'refresh');
		}
	}

	public function cmp_inv_time(array $a, array $b) {
		if ($a['time'] < $b['time']) {
			return 1;
		} else if ($a['time'] > $b['time']) {
			return -1;
		} else {
			return 0;
		}
	}

	public function get_roomdata($list_room){
		$roomdatas = array();
     	foreach ($list_room as $room) {
     		$roomdatas[$room->idChatRoom] = $this->db_room->info($room->idChatRoom, $room->countUnread, $room->dateJoin);
     	}

     	return $roomdatas;
	}

	public function get_lastchat($list_room){
		$last_chat = array();
		foreach ($list_room as $room) {
			$result = $this->db_chat->getLastChat($room['id_room'], $room['date_join']);
			$last_chat[$room['id_room']] = $room;
			$last_chat[$room['id_room']]['chat_msg'] = $result['chatMsg'];
			$last_chat[$room['id_room']]['time'] = $result['time'];
		}
		return $last_chat;
	}

	public function listing_friend($id)
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