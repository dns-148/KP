<?php

Class db_room extends CI_Model{
	function info($id_room){
	    $this->db->select('idRoom, namaRoom, idAdmin, tipe, roomPict');
	    $this->db->from('public.listChatRoom');
	    $this->db->where('idRoom', $id_room);
 
		$query = $this->db->get();
	 
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	function addRoom($admin_id, $nama_room, $tipe, $pict){
		if($tipe == 2){
			$pict = 'user_0.png';
		}
		$time = date('Y-m-j H:i:s');
		$data = array(
				'namaRoom' => $nama_room,
				'idAdmin' => $admin_id,
				'tipe' => $tipe,
				'roomPict' => $pict,
				'timeCreated' => $time
			);
		$this->db->insert('public.listChatRoom',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function linkUser($list_user, $admin_id, $room_id){
		$user = explode(',', $list_user);
		$data = array(
			'idChatRoom' => $room_id,
			'idUser' => $admin_id
			);
		$this->db->insert('public.refRoomUser', $data);

		foreach ($user as $id ) {
			$data = array(
				'idChatRoom' => $room_id,
				'idUser' => $id
			);
			$this->db->insert('public.refRoomUser', $data);
		}
	}
}
?>