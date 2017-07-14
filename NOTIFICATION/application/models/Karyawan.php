<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Model {

  public function cek_karyawan($table,$where)
  {
    return $this->db->get_where($table,$where);
  }

  public function getBirthdayRequest() {
    $querylineCount = "SELECT * FROM karyawan WHERE DATE_FORMAT(Tanggal_lahir,'%m-%d') = DATE_FORMAT(SYSDATE(), '%m-%d')";
    $query = $this->db->query($querylineCount);
    return $query->num_rows();
  }

  public function get_id($id_karyawan){
    return $this->db->get_where('karyawan',array('id_karyawan' => $id_karyawan));
  }
}
