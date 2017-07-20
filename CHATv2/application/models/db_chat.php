<?php

Class db_chat extends CI_Model{
	function fetchAll($room){
	    $this->db->select('*');
		$this->db->from($room);
		$this->db->join('public.user', 'ID = idPoster', 'left');
 
		$query = $this->db->get();
		$result = $query->result_array();
	 
		if($query->num_rows() > 0)
		{
			return $result;
		}else{
			return false;
		}
	}

	function addChat($room, $id_user, $time, $tipe, $msg){
		$data = array(
				'idPoster' => $id_user,
				'tipe' => $tipe,
				'chatMsg' => $msg,
				'time' => $time
			);
		$this->db->insert($room, $data);
	}
}
?>