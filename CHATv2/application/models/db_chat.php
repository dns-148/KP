<?php

Class db_chat extends CI_Model{
	function fetchAll($room, $date_join){
	    $this->db->select('*');
		$this->db->from($room);
		$this->db->join('public.user', 'ID = idPoster', 'left');
		$this->db->where('time >', $date_join);
 
		$query = $this->db->get();
		$result = $query->result_array();
	 
		if($query->num_rows() > 0)
		{
			return $result;
		}else{
			return false;
		}
	}

	function getLastChat($room_id, $date_join){
		$room = 'public.Room'.$room_id;
		$this->db->select('chatMsg, time, tipe');
		$this->db->from($room);
		$this->db->where('time >', $date_join);
		$this->db->order_by('time',"desc");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();

		if($query->num_rows() > 0)
		{
			$formated_result = array(
				'chatMsg' => $result[0]['chatMsg'],
				'time'	=> $result[0]['time'],
				'tipe'	=> $result[0]['tipe']
				);
		}else{
			$formated_result = array(
				'chatMsg' => NULL,
				'time'	=> NULL,
				'tipe' => NULL
				);
		}
		return $formated_result;
	}

	function addChat($room, $id_user, $tipe, $msg){
		$timestamp = date('Y-m-d H:i:s');
		$data = array(
				'idPoster' => $id_user,
				'tipe' => $tipe,
				'chatMsg' => $msg,
				'time' => $timestamp
			);
		$this->db->insert($room, $data);
		return $timestamp;
	}
}
?>