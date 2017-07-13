<?php

Class db_user extends CI_Model{
	function login($username, $password){
	    $this-> db ->select('ID, Nama, Username');
	    $this-> db ->from('public.user');
	    $this-> db ->where('Username', $username);
	    $this-> db ->where('Password', $password);
	    $this-> db ->limit(1);
 
		$query = $this-> db ->get();
	 
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}else{
			return false;
		}
	}
}
?>