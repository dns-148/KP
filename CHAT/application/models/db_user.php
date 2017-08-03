<?php

Class db_user extends CI_Model{
	function check_status($email){
		$this->db->select('*');
	    $this->db->from('public.user');
	    $this->db->where('Email', $email);
		$this->db->where('Status', "Aktif");
		$query = $this->db->get();
	 
		if($query->num_rows() == 1)
		{
			return true;
		}else{
			return false;
		}
	}

	function login($email, $password){
	    $this->db->select('ID, Nama, ProfilePict');
	    $this->db->from('public.user');
	    $this->db->where('Email', $email);
	    $this->db->where('Password', $password);
	    $this->db->limit(1);
 
		$query = $this->db->get();
	 
		if($query->num_rows() == 1)
		{
			return $query->result_array();
		}else{
			return false;
		}
	}

	function allUserData($id){
		$this->db->select('ID, Nama, ProfilePict');
		$this->db->from('public.user');
		$this->db->where('ID !=', $id);
		$this->db->where('Status', "Aktif");
 
		$query = $this->db->get();
	 
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else{
			return false;
		}
	}

	function userData($id){
		$this->db->select('ID, Nama, ProfilePict');
		$this->db->from('public.user');
	    $this->db->where('ID', $id);
	    $this->db->limit(1);
 
		$query = $this->db->get();
	 
		if($query->num_rows() == 1)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	function roomParticipate($id_user){
		$this->db->select('idChatRoom, countUnread, dateJoin');
		$this->db->from('public.refRoomUser');
		$this->db->where('idUser', $id_user);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	function updateUnread($room_id, $user_id, $unread_count){
		$array = array('countUnread' => $unread_count);
		$this->db->where('idChatRoom', $room_id);
		$this->db->where('idUser', $user_id);
		$this->db->update('public.refRoomUser', $array);	
	}

	function getUnread($room_id, $user_id){
		$array = array('idUser' =>  $user_id, 'idChatRoom' => $room_id);
		$this->db->select('countUnread');
		$this->db->from('public.refRoomUser');
		$this->db->where($array);
		$query = $this->db->get();

		return $query->result_array();
	}

	function fetchDateJoin($id_room, $id_user){
		$array = array('idUser' =>  $id_user, 'idChatRoom' => $id_room);
		$this->db->select('dateJoin');
		$this->db->from('public.refRoomUser');
		$this->db->where($array);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else{
			return false;
		}
		
	}
}
?>