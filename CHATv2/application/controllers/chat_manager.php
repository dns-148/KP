<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat_manager extends CI_Controller {
	
	public function create_roomchat()
	{
		$group_name = $this->input->post('group_name');
		$user_id = $this->input->post('user_id');
		$users = $this->input->post('friend_list');
		$friend_list = explode(',', $users);
		$tipe = 2;
		$picture = NULL;

		$id_room = $this->db_room->addRoom($user_id, $group_name, $tipe, $picture);
		$this->db_room->linkUser($friend_list, $user_id, $id_room);
		$query = 'CREATE TABLE public."Room'.$id_room.'"("idChat" serial NOT NULL, "idPoster" integer, "tipe" integer NOT NULL, "chatMsg" text, "time" timestamp without time zone NOT NULL, CONSTRAINT "Room'.$id_room.'_pkey" PRIMARY KEY ("idChat"), CONSTRAINT "refPoster" FOREIGN KEY ("idPoster") REFERENCES public."user" ("ID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE SET NULL);';
		$result = $this->db->query($query);
		$return_val = array(
			'name' => $group_name,
			'image' => 'user_0.png',
			'room' => $id_room,
			'list' => $friend_list,
			'url' => base_url('chat/room?room=').$id_room
			);
		echo json_encode($return_val);
	}

	public function send_msg(){
		$session_data = $this->session->userdata('logged_in');
		$room_id = $session_data['room'];
		$room = 'public.Room' . $room_id;
		$user_id = $session_data['id'];
		$tipe = $this->input->post('tipe');
		$msg = $this->input->post('msg');

		$unformated_time = $this->db_chat->addChat($room, $user_id, $tipe, $msg);
		echo json_encode($unformated_time);
	}

	public function update_unread(){
		$session_data = $this->session->userdata('logged_in');
		$room_id = $this->input->post('room');
		$user_id = $session_data['id'];
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

	public function upload_file(){
		$config['upload_path']		= './file_upload/';
		$config['allowed_types']	= 'gif|jpg|png|rar|zip|doc|docx|ppt|pptx|xls|xlsx|pdf|txt';
		$config['max_size']			= 10000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')){
			 $error = array('error' => $this->upload->display_errors());
			 echo print_r($error);
		}else{
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			$ext_file = $upload_data['file_type'];
			$url = base_url('./file_upload/') . $file_name;

			if(strpos($ext_file, "image") !== false){
				$tipe = 2;
			}else{
				$tipe = 3;
			}

			$session_data = $this->session->userdata('logged_in');
			$room_id = $session_data['room'];
			$room = 'public.Room' . $room_id;
			$user_id = $session_data['id'];
			
			$time = $this->db_chat->addChat($room, $user_id, $tipe, $file_name);
			$return_val = array(
				'tipe' => $tipe,
				'time' => $time,
				'url' => $url
				);
			echo json_encode($return_val);
		}
	}
}