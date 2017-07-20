<?php

Class db_user extends CI_Model{
	function login($username, $password){
	    $this->db->select('ID, Nama, Username, ProfilePict');
	    $this->db->from('public.user');
	    $this->db->where('Username', $username);
	    $this->db->where('Password', $password);
	    $this->db->limit(1);
 
		$query = $this->db->get();
	 
		if($query->num_rows() == 1)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	function userData($id){
		$this->db->select('ID, Nama, Username, ProfilePict');
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
		$this->db->select('idChatRoom');
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

	function friendList($id_user){
		$this->db->select('idUser1, idUser2');
		$this->db->from('public.listFriend');
		$this->db->where('idUser1', $id_user);
		$this->db->or_where('idUser2', $id_user);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}
}
?>