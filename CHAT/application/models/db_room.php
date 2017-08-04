<?php

Class db_room extends CI_Model{
	function info($id_room, $unread_count, $date_join){
	    $this->db->select('idRoom, namaRoom, idAdmin, tipe, roomPict, timeCreated');
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
					'time_created' => $result[0]['timeCreated'],
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
		$time = date('Y-m-d H:i:s');
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
		$this->db->where('Status', "Aktif");
 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function getIdUserParticipate($room_id){
		$formated_result = array();
		$this->db->select('idUser');
		$this->db->from('public.refRoomUser');
		$this->db->where('idChatRoom', $room_id);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $row) {
			array_push($formated_result, $row['idUser']);
		}
		return $formated_result;
	}

	function linkUser($list_user, $admin_id, $room_id){
		$timestamp = date('Y-m-d H:i:s');
		if($admin_id > -1){
			$data = array(
				'idChatRoom' => $room_id,
				'idUser' => $admin_id,
				'dateJoin' => $timestamp,
				'countUnread' => 0
				);
			$this->db->insert('public.refRoomUser', $data);
		}

		foreach ($list_user as $id ) {
			$data = array(
				'idChatRoom' => $room_id,
				'idUser' => $id,
				'dateJoin' => $timestamp,
				'countUnread' => 0
			);
			$this->db->insert('public.refRoomUser', $data);
		}
	}

	function changeAdmin($room_id, $user_id){
		$array = array('idAdmin' => $user_id);
		$this->db->where('idRoom', $room_id);
		$this->db->update('public.listChatRoom', $array);
	}

	function setUnused($room_id, $room_name){
		$newName = "[System - Chat Abandoned] ".$room_name;
		$array = array('namaRoom' => $newName);
		$this->db->where('idRoom', $room_id);
		$this->db->update('public.listChatRoom', $array);
	}

	function nextAdminCandidate($room_id){
		$this->db->select('idUser');
		$this->db->from('public.refRoomUser');
		$this->db->where('idChatRoom', $room_id);
		$this->db->order_by('dateJoin', 'asc');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$array_result = $query->result_array();
			$result = $array_result[0]['idUser'];
			return $result;
		}else{
			return false;
		}
	}

	function getAdmin($room_id){
		$this->db->select('idAdmin');
		$this->db->from('public.listChatRoom');
		$this->db->where('idRoom', $room_id);
		$query = $this->db->get();
		$array_result = $query->result_array();
		$result = $array_result[0]['idAdmin'];
		return $result;
	}

	function leaveRoom($room_id, $user_id){
		$array = array('idUser' =>  $user_id, 'idChatRoom' => $room_id);
		$this->db->where($array);
  		$this->db->delete('public.refRoomUser');
	}
}
?>