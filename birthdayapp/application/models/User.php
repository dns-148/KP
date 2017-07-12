<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

  public function getBirthdayRequest() {
    //$cek="select Tanggal_lahir from karyawan where id_karyawan=1";
    //echo $cek;
    $querylineCount = "SELECT * FROM karyawan WHERE TO_CHAR(Tanggal_lahir,'MM-DD')=TO_CHAR(sysdate(), 'MM-DD')";
    $query = $this->db->query($querylineCount);
    return $query->num_rows();
    }
}
