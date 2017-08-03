<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Model {

  public function get_data($email, $password)
  {
    $this->db->select('id_karyawan, nama, email');
    $this->db->from('myschema.karyawan');
    $this->db->where('email', $email);
    $this->db->where('password', $password);
     $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      return $query->result();
    }
    else{
      return FALSE;
    }
  }

  public function getBirthdayRequest() {
    $querylineCount = "SELECT * FROM myschema.karyawan WHERE TO_CHAR(tanggal_lahir,'%mm-%dd') = TO_CHAR(NOW(), '%mm-%dd')";
    $query = $this->db->query($querylineCount);
    return $query->num_rows();
  }

  public function showBirthdayRequest() {
    $querylineCount = "SELECT id_karyawan, nama, tanggal_lahir FROM myschema.karyawan WHERE TO_CHAR(tanggal_lahir,'%mm-%dd') = TO_CHAR(NOW(), '%mm-%dd')";
    $query = $this->db->query($querylineCount);

    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

  public function get_id($id_karyawan){
		return $this->db->query("SELECT nama, jenis_kelamin FROM myschema.karyawan WHERE id_karyawan='$id_karyawan'")->result();
	}

}
