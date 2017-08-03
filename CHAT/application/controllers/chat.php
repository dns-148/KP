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
               $data['timezone'] = $session_data['timezone'];
     		$data['profilepict'] = $session_data['profilepict'];
     		$data['friend'] = $this->listing_friend($data['id']);

     		$list_room = $this->db_user->roomParticipate($data['id']);
     		
          	if($list_room){
          		$data['room'] = -2;
          		$session_data['room'] = -2;
          		$data['room_info'] = NULL;
          		$data['list_user'] = NULL;
                    $data['unread'] = 0;
          		$list_room = $this->get_roomdata($list_room);
          		$data['allroom_info'] = $this->get_lastchat($list_room);
          		usort($data['allroom_info'], array($this,'cmp_inv_time'));
          	}else{
          		$data['room'] = -2;
          		$data['allroom_info'] = NULL;
          		$data['room_info'] = NULL;
          		$data['last_chat'] = NULL;
          		$data['list_user'] = NULL;
                    $data['unread'] = 0;
          	}

     		$data['list_chat'] = false;
     		$data['user_participate'] = false;

     		$this->load->view('chat_2', $data);
		}else{
			redirect('login', 'refresh');
		}
	}

	public function room()
	{
		if($this->session->userdata('logged_in')){
			$prev_id = $this->input->get('room', true);
			$session_data = $this->session->userdata('logged_in');

               $data = $this->prepare_data($prev_id, $session_data['id']);
               $data['nama'] = $session_data['nama'];
               $data['id'] = $session_data['id'];
               $data['timezone'] = $session_data['timezone'];
               $data['profilepict'] = $session_data['profilepict'];
               $session_data['room'] = $data['room'];

               $this->session->set_userdata('logged_in', $session_data);
     		$this->load->view('chat', $data);
		}else{
			redirect('login', 'refresh');
		}
	}

     public function modal(){
          $session_data = $this->session->userdata('logged_in');
          $data['friend'] = $this->listing_friend($session_data['id']);
          $data['list_user'] = $this->db_room->getIdUserParticipate($session_data['room']);
          $this->load->view('modal', $data);
     }

     public function prepare_data($room_id_ref, $user_id){
          $data['room'] = $room_id_ref;
          $temp_unread = $this->db_user->getUnread($data['room'], $user_id);
          $data['unread'] = $temp_unread[0]['countUnread'];
          $this->db_user->updateUnread($room_id_ref, $user_id, 0);

          $list_room = $this->db_user->roomParticipate($user_id);
               
          if($list_room){
               if($room_id_ref > -1){
                    $data['room'] = $room_id_ref;
                    $date_join = $this->db_user->fetchDateJoin($data['room'], $user_id);
                    $data['room_info'] = $this->db_room->info($data['room'], 0, $date_join);
               }else{
                    $data['room'] = -1;
                    $data['room_info'] = NULL;
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
               $date_join = $this->db_user->fetchDateJoin($data['room'], $user_id);
               $data['list_chat'] = $this->db_chat->fetchAll($nama_room, $date_join[0]['dateJoin']);
               $data['user_participate'] = $this->db_room->allUserParticipate($data['room']);
          }else{
               $data['list_chat'] = false;
               $data['user_participate'] = false;
          }

          return $data;
     }

	public function cmp_inv_time(array $a, array $b) {
		$a_time = ($a['time']? $a['time'] : $a['time_created']);
		$b_time = ($b['time']? $b['time'] : $b['time_created']);
		if ($a_time < $b_time) {
			return 1;
		} else if ($a_time > $b_time) {
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
               $last_chat[$room['id_room']]['tipe'] = $result['tipe'];
		}
		return $last_chat;
	}

	public function listing_friend($id)
	{
		$result = $this->db_user->allUserData($id);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
}