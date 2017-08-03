<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalender extends CI_Model {

  public function getEventRequest() {
    $query1 = "SELECT * FROM myschema.kalender WHERE TO_CHAR(tgl_event,'%mm-%dd') = TO_CHAR(NOW(), '%mm-%dd')";
    $data1 = $this->db->query($query1);
    $a = $data1->num_rows();

    $query2 = "SELECT * FROM myschema.karyawan WHERE TO_CHAR(tanggal_lahir,'%mm-%dd') = TO_CHAR(NOW(), '%mm-%dd')";
    $data2 = $this->db->query($query2);
    $b = $data2->num_rows();

    return $a + $b;
  }

  public function showEventRequest() {
    $querylineCount = "SELECT nama_event, tgl_event FROM myschema.kalender WHERE TO_CHAR(tgl_event,'%mm-%dd') = TO_CHAR(NOW(), '%mm-%dd')";
    $query = $this->db->query($querylineCount);

    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

  public function getComment($id_karyawan){
    $query3 = "SELECT * FROM myschema.ucapan join myschema.karyawan on id_karyawan=created_by WHERE TO_CHAR(waktu,'%mm-%dd-%yyyy') = TO_CHAR(NOW(), '%mm-%dd-%yyyy')
    and id_ultah=$id_karyawan and (id_ultah <> created_by)";
     $data3 = $this->db->query($query3);
     $c = $data3->num_rows();
     return $c;
  }
}
