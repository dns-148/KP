<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat_manager extends CI_Controller {
	
	public function create_roomchat()
	{
		$group_name = $this->input->post('group_name');
		$user_id = $this->input->post('user_id');
		$friend_list = $this->input->post('friend_list');
		if(substr_count($friend_list, ',') < 1){
			$session_data = $this->session->userdata('logged_in');
			$tipe = 1;
			$data = $this->db_user->userData($friend_list);
			$group_name = $data[0]->Nama . ' - ' . $session_data['nama'];
			$picture = $data[0]->ProfilePict;
		}else{
			$tipe = 2;
			$picture = NULL;
		}

		$id_room = $this->db_room->addRoom($user_id, $group_name, $tipe, $picture);
		$this->db_room->linkUser($friend_list, $user_id, $id_room);
		$query = 'CREATE TABLE public."Room'.$id_room.'"("idChat" serial NOT NULL, "idPoster" integer, "tipe" integer NOT NULL, "chatMsg" text, "time" timestamp without time zone NOT NULL, CONSTRAINT "Room'.$id_room.'_pkey" PRIMARY KEY ("idChat"), CONSTRAINT "refPoster" FOREIGN KEY ("idPoster") REFERENCES public."user" ("ID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE SET NULL);';
		$result = $this->db->query($query);
		redirect('chat', 'refresh');
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
}