<?php
defined('BASEPATH') or exit('No direct access allowed');

class M_Confrimation extends CI_Model
{
  public function getById_NilaiSkp($id)
  {
    $query =
      "SELECT skp.*, bulan.*
        FROM skp
        LEFT JOIN user ON user.user_id = skp.user
        LEFT JOIN bulan ON bulan.id_bulan = skp.bulan
        WHERE skp.id_skp = $id AND skp.cek_validasi = 1";
    return $this->db->query($query);
  }

  public function getSKP_Nilai()
  {
    $bulan = date('m', strtotime(" - 1 months"));
    $tahun = date("Y");
    $query =
      "SELECT skp.*, bulan.*, user.name, 
      (SELECT COUNT(id) FROM kegiatan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' AND kegiatan.skp = skp.id_skp) as jml_kegiatan
      FROM skp
      LEFT JOIN user ON user.user_id = skp.user
      LEFT JOIN bulan ON bulan.id_bulan = skp.bulan
      WHERE skp.cek_validasi = 1";
    return $this->db->query($query);
  }
}
