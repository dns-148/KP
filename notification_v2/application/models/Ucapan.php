<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ucapan extends CI_Model {

  public function insert_greeting($ucapan, $id_post, $id_ultah){
    $input = array(
      'isi_ucapan' => $ucapan,
      'created_by' => $id_post,
      'id_ultah' => $id_ultah
      );
    return $this->db->insert("myschema.ucapan", $input);
  }

  public function showGreeting($id_karyawan){

    $query1= "SELECT * from myschema.karyawan join myschema.ucapan on id_karyawan=created_by where TO_CHAR(waktu,'%mm-%dd-%yyyy') = TO_CHAR(NOW(), '%mm-%dd-%yyyy') and id_ultah='$id_karyawan'
    order by waktu DESC";
    $query = $this->db->query($query1);
    return $query->result();
  }

  public function showGreetingRequest() {
    $querylineCount = "SELECT * FROM myschema.ucapan, myschema.karyawan WHERE id_karyawan=created_by AND TO_CHAR(waktu, '%mm-%dd-%yyyy') = TO_CHAR(NOW(), '%mm-%dd-%yyyy')";
    $query = $this->db->query($querylineCount);

    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

}
