<?php
defined('BASEPATH') or exit('No direct access allowed');

class M_Kegiatan extends CI_Model
{
  public function getLastKegiatan($hari, $bulan, $tahun, $code)
  {
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $this->db->select('kegiatan.kegiatan_id');
    $this->db->from('kegiatan');
    $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
    $this->db->join('kegiatancode', 'user.role_id = kegiatancode.id', 'left');
    $this->db->order_by('kegiatan.kegiatan_id', 'DESC');
    $this->db->where('kegiatancode.kegiatan_code=', $code);
    $this->db->where('DAY(tanggal)', $hari);
    $this->db->where('MONTH(tanggal)', $bulan);
    $this->db->where('YEAR(tanggal)', $tahun);
    $this->db->limit(1);
    return $this->db->get();
  }

  public function getKegiatanKode()
  {
    $data = $this->session->userdata('email');
    $query = "SELECT `kegiatancode`.`kegiatan_code`,`user`.* 
    FROM `kegiatancode` LEFT JOIN `user` ON `user`.`role_id` = `kegiatancode`.`id` 
    WHERE `user`.`email` = '" . $data . "'";
    return $this->db->query($query)->row();
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

  public function getKegiatanById($id)
  {
    $this->db->select('kegiatan.*, unit_kerja.*, skp.nama_skp, file.extension, user.name, user.role_id, user.user_id');
    $this->db->from('kegiatan');
    $this->db->join('unit_kerja', 'kegiatan.unitkerja = unit_kerja.id_unit_kerja', 'left');
    $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
    $this->db->join('skp', 'kegiatan.skp = skp.id_skp', 'left');
    $this->db->join('file', 'kegiatan.file_categories = file.file_id', 'left');
    if ($id == '') {
      return $this->db->get();
    }
    $this->db->where('user.user_id=', $id);
    return $this->db->get();
  }

  public function getDataKegiatan()
  {
    if ($this->session->userdata('role_id') == 1) {
      $this->db->select('kegiatan.*, user.name, unit_kerja.nama_unit_kerja, skp.nama_skp');
      $this->db->from('kegiatan');
      $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
      $this->db->join('unit_kerja', 'kegiatan.unitkerja = unit_kerja.id_unit_kerja', 'left');
      $this->db->join('skp', 'kegiatan.skp = skp.id_skp', 'left');
      $this->db->order_by('id', 'ASC');
      return $this->db->get();
    } else if ($this->session->userdata('role_id') == 2) {
      $this->db->select('kegiatan.*, user.name, unit_kerja.nama_unit_kerja, skp.nama_skp');
      $this->db->from('kegiatan');
      $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
      $this->db->join('unit_kerja', 'kegiatan.unitkerja = unit_kerja.id_unit_kerja', 'left');
      $this->db->join('skp', 'kegiatan.skp = skp.id_skp', 'left');
      $this->db->order_by('id', 'ASC');
      $this->db->where('kegiatan.user!=1');
      return $this->db->get();
    } else {
      $data = $this->session->userdata('user_id');
      $this->db->select('kegiatan.*, user.user_id, skp.nama_skp');
      $this->db->from('kegiatan');
      $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
      $this->db->join('skp', 'kegiatan.skp = skp.id_skp', 'left');
      $this->db->order_by('kegiatan.id', 'ASC');
      $this->db->where('user.user_id=', $data);
      return $this->db->get();
    }
  }

  public function getDataKegiatanById($id)
  {
    $this->db->select('kegiatan.*, user.name, unit_kerja.nama_unit_kerja, skp.nama_skp');
    $this->db->from('kegiatan');
    $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
    $this->db->join('unit_kerja', 'kegiatan.unitkerja = unit_kerja.id_unit_kerja', 'left');
    $this->db->join('skp', 'kegiatan.skp = skp.id_skp', 'left');
    $this->db->where('kegiatan.user=', $id);
    $this->db->order_by('id', 'ASC');
    return $this->db->get();
  }

  public function getDataFile()
  {
    $data = $this->session->userdata('user_id');
    $this->db->select('kegiatan.*, user.user_id');
    $this->db->from('kegiatan');
    $this->db->join('user', 'kegiatan.user = user.user_id', 'left');
    $this->db->order_by('kegiatan.id', 'ASC');
    $this->db->where('user.user_id=', $data);
    return $this->db->get();
  }

  public function getDataEditKegiatan($id)
  {
    $data = array(
      'kegiatan.id' => $id,
    );
    $this->db->select('kegiatan.*, file.file_id, user.*, unit_kerja.nama_unit_kerja');
    $this->db->from('kegiatan');
    $this->db->join('file', 'kegiatan.file_categories = file.file_id');
    $this->db->join('user', 'kegiatan.user = user.user_id');
    $this->db->join('unit_kerja', 'kegiatan.unitkerja = unit_kerja.id_unit_kerja');
    $this->db->where($data);
    return $this->db->get();
  }

  public function getDataSKP()
  {
    $data = $this->session->userdata('user_id');
    $bulan = date("m");
    $tahun = date("Y");
    $query = "SELECT * FROM skp WHERE user = '$data' AND bulan = '$bulan' AND tahun = '$tahun'";
    return $this->db->query($query);
  }

  public function delete_kegiatan($id)
  {
    $this->db->where(['id' => $id]);
    return $this->db->delete('kegiatan');
  }
}
