<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat_manager extends CI_Controller {
	
	public function create_roomchat()
	{
		$group_name = $this->input->post('group_name');
		$user_id = $this->input->post('user_id');
		$users = $this->input->post('friend_list');
		$friend_list = explode(',', $users);
		// if(substr_count($friend_list, ',') < 1){
		// 	$session_data = $this->session->userdata('logged_in');
		// 	$tipe = 1;
		// 	$data = $this->db_user->userData($friend_list);
		// 	$group_name = $user_id;
		// 	$picture = $user_id;
		// }else{
		$tipe = 2;
		$picture = NULL;
		// }

		$id_room = $this->db_room->addRoom($user_id, $group_name, $tipe, $picture);
		$this->db_room->linkUser($friend_list, $user_id, $id_room);
		$query = 'CREATE TABLE public."Room'.$id_room.'"("idChat" serial NOT NULL, "idPoster" integer, "tipe" integer NOT NULL, "chatMsg" text, "time" timestamp without time zone NOT NULL, CONSTRAINT "Room'.$id_room.'_pkey" PRIMARY KEY ("idChat"), CONSTRAINT "refPoster" FOREIGN KEY ("idPoster") REFERENCES public."user" ("ID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE SET NULL);';
		$result = $this->db->query($query);
		$return_val = array(
			'name' => $group_name,
			'image' => 'user_0.png',
			'room' => $id_room,
			'list' => $friend_list,
			'url' => base_url('chat/index?room=').$id_room
			);
		echo json_encode($return_val);
	}

	public function send_msg(){
		$room_id = $this->input->post('room');
		$room = 'public.Room' . $room_id;
		$user_id = $this->input->post('user_id');
		$time = $this->input->post('time');
		$tipe = $this->input->post('tipe');
		$msg = $this->input->post('msg');

		$this->db_chat->addChat($room, $user_id, $time, $tipe, $msg);
	}

	public function update_unread(){
		$room_id = $this->input->post('room');
		$user_id = $this->input->post('user_id');
		$unread = $this->input->post('unread');

		$this->db_user->updateUnread($room_id, $user_id, $unread);
	}

	public function add_user(){
		$room_id = $this->input->post('room');
		$user_list = $this->input->post('user_list');
		$friend_list = explode(',', $user_list);
		$this->db_room->linkUser($friend_list, -1, $room_id);
		$return_val = array();
		foreach ($friend_list as $row) {
			if($row){
				$result = $this->db_user->userData($row);
				$temp = array(
					'id' => $result[0]->ID,
					'nama' => $result[0]->Nama,
					'profile_pict' => $result[0]->ProfilePict
					);
				array_push($return_val, $temp);
			}
		}

		echo json_encode($return_val);
	}

	public function leave_chat(){
		$room_id = $this->input->post('room');
		$user_id = $this->input->post('user_id');
		$this->db_room->leaveRoom($room_id, $user_id);

		echo json_encode(true);
	}
}