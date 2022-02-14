<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pengguna extends CI_Model
{
  public function getPenggunaId($id)
  {
    $query = "SELECT * FROM user WHERE user_id = $id";
    return $this->db->query($query);
  }

  public function getPenggunaAdmin()
  {
    $query = "SELECT role_id FROM user WHERE role_id = 1";
    return $this->db->query($query);
  }

  public function allPengguna()
  {
    $role = $this->session->userdata('role_id');
    if ($role == 1) {
      $query = "SELECT DISTINCT role_id FROM user";
      return $this->db->query($query);
    } else if ($role == 2) {
      $query = "SELECT DISTINCT role_id FROM user WHERE role_id != 1";
      return $this->db->query($query);
    }
  }

  public function delete_user($id)
  {
    $this->db->where('user_id', $id);
    return $this->db->delete('user');
  }

  public function getWAPengguna($id)
  {
    $data = array(
      'user.user_id' => $id,
    );
    $this->db->select('user.name, user.email, user.telephone');
    $this->db->from('user');
    $this->db->where($data);
    return $this->db->get();
  }
}
