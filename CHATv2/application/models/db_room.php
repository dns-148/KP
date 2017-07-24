<?php

Class db_room extends CI_Model{
	function info($id_room, $unread_count, $date_join){
	    $this->db->select('idRoom, namaRoom, idAdmin, tipe, roomPict');
	    $this->db->from('public.listChatRoom');
	    $this->db->where('idRoom', $id_room);
 
		$query = $this->db->get();
	 
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$formated_result = array(
					'id_room' => $result[0]['idRoom'],
					'nama_room' => $result[0]['namaRoom'],
					'id_admin' => $result[0]['idAdmin'],
					'tipe' => $result[0]['tipe'],
					'room_pict' => $result[0]['roomPict'],
					'date_join' => $date_join,
					'unread_count' => $unread_count
				);

			return $formated_result;
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

	function allUserParticipate($room_id){
		$this->db->select('*');
		$this->db->from('public.refRoomUser');
		$this->db->join('public.user', 'ID = idUser', 'left');
		$this->db->where('idChatRoom', $room_id);
 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function linkUser($list_user, $admin_id, $room_id){
		$user = explode(',', $list_user);
		$timestamp = date('Y-m-d H:i:s');
		$data = array(
			'idChatRoom' => $room_id,
			'idUser' => $admin_id,
			'dateJoin' => $timestamp,
			'countUnread' => 0
			);
		$this->db->insert('public.refRoomUser', $data);

		foreach ($user as $id ) {
			$data = array(
				'idChatRoom' => $room_id,
				'idUser' => $id,
				'dateJoin' => $timestamp,
				'countUnread' => 0
			);
			$this->db->insert('public.refRoomUser', $data);
		}
	}
}
?>