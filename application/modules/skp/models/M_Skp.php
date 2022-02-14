<?php
defined('BASEPATH') or exit('No direct access allowed');

class M_Skp extends CI_Model
{
  // SKP
  public function getDataSKP()
  {
    if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) {
      $query = "SELECT `user`.*,`skp`.*,`bulan`.*
      FROM `skp`
      LEFT JOIN `user` ON `user`.`user_id`=`skp`.`user`
      LEFT JOIN `bulan` ON `bulan`.`id_bulan`=`skp`.`bulan`";
      return $this->db->query($query);
    } else {
      $data = $this->session->userdata('user_id');
      $query = "SELECT `user`.*,`skp`.*,`bulan`.*
      FROM `skp`
      LEFT JOIN `user` ON `user`.`user_id`=`skp`.`user`
      LEFT JOIN `bulan` ON `bulan`.`id_bulan`=`skp`.`bulan`
      WHERE `skp`.`user`=$data";
      return $this->db->query($query);
    }
  }

  public function getDataSKPById($id)
  {
    $query =
      "SELECT user.*, skp.*, bulan.*, 
      (SELECT COUNT(id) FROM kegiatan WHERE kegiatan.user = '$id' AND MONTH(tanggal) = skp.bulan AND YEAR(tanggal) = skp.tahun AND kegiatan.skp = skp.id_skp AND skp.user = kegiatan.user) as jml_kegiatan
      FROM skp
      LEFT JOIN user ON user.user_id = skp.user
      LEFT JOIN bulan ON bulan.id_bulan = skp.bulan
      WHERE skp.user = $id";
    return $this->db->query($query);
  }

  public function getNilaiSKP($id)
  {
    if ($this->session->userdata('role_id') == 1) {
      $query =
        "SELECT skp.*, bulan.*
      FROM skp
      LEFT JOIN user ON user.user_id = skp.user
      LEFT JOIN bulan ON bulan.id_bulan = skp.bulan
      WHERE skp.id_skp = $id";
      return $this->db->query($query);
    } else if ($this->session->userdata('role_id') == 2) {
      $query =
        "SELECT skp.*, bulan.*
      FROM skp
      LEFT JOIN user ON user.user_id = skp.user
      LEFT JOIN bulan ON bulan.id_bulan = skp.bulan
      WHERE skp.id_skp = $id";
      return $this->db->query($query);
    } else {
      $data = $this->session->userdata('user_id');
      $query =
        "SELECT skp.*, bulan.*
        FROM skp
        LEFT JOIN user ON user.user_id = skp.user
        LEFT JOIN bulan ON bulan.id_bulan = skp.bulan
        WHERE skp.user = $data AND skp.id_skp = $id";
      return $this->db->query($query);
    }
  }

  public function getUserExport()
  {
    if ($this->session->userdata('role_id') == 1) {
      $this->db->select('*');
      $this->db->from('user');
      return $this->db->get();
    } else if ($this->session->userdata('role_id') == 2) {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('user.role_id!=1');
      return $this->db->get();
    } else {
      $data = $this->session->userdata('name');
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('user.name=', $data);
      return $this->db->get();
    }
  }

  public function getSKPById($id)
  {
    $this->db->select('skp.*, bulan.*, user.name, user.role_id, user.user_id');
    $this->db->from('skp');
    $this->db->join('bulan', 'skp.bulan = bulan.id_bulan', 'left');
    $this->db->join('user', 'skp.user = user.user_id', 'left');
    if ($id == '') {
      return $this->db->get();
    }
    $this->db->where('user.user_id=', $id);
    return $this->db->get();
  }

  public function delete_skp($id)
  {
    $this->db->where('id_skp', $id);
    return $this->db->delete('skp');
  }

  public function ubah_skp($data)
  {
    $this->db->where('id_riwayat', $this->input->post('id_riwayat'));
    return $this->db->update('riwayat', $data);
  }

  public function getDataEditSKP($id)
  {
    $query = "SELECT user.user_id, user.name, skp.*, bulan.*
    FROM skp
    LEFT JOIN user ON user.user_id=skp.user
    LEFT JOIN bulan ON bulan.id_bulan=skp.bulan
    WHERE skp.id_skp='$id'";
    return $this->db->query($query);
  }
}
