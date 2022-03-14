<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{
    public function Mdelete_role($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_role');
    }

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function Mdelete_submenu($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_sub_menu');
    }

    public function getDataEditSubmenu($id)
    {
        $data = array(
            'user_sub_menu.id' => $id,
        );
        $this->db->select('user_sub_menu.*, user_menu.menu');
        $this->db->from('user_sub_menu');
        $this->db->where($data);
        $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
        return $this->db->get();
    }

    public function ubah_submenu($data)
    {
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('user_sub_menu', $data);
    }

    function getPresensibyHari()
    {
        $hari = date("Y-m-d");
        $query = "SELECT pr.date, st.status, 
        (SELECT COUNT(id) FROM presensi WHERE date = '$hari' AND cek_presensi = 1 AND status=st.id_status) as tepatwaktu,
        (SELECT COUNT(id) FROM presensi WHERE date = '$hari' AND cek_presensi = 2 AND status=st.id_status) as terlambat
        FROM presensi pr, status st
        WHERE pr.date = '$hari' AND pr.status = st.id_status
        GROUP BY pr.status";
        return $this->db->query($query);
    }

    function getPresensibyBulan()
    {
        $tahun = date("Y");
        $query = "SELECT id_bulan, nama_bulan as bln, tepatwaktu, terlambat from bulan 
        LEFT JOIN( 
            SELECT MONTH(date) AS name, COUNT(id) AS tepatwaktu
            FROM presensi 
            WHERE YEAR(date) = '$tahun' AND cek_presensi = 1
            GROUP BY MONTH(date)
            ) 
        tw ON (bulan.id_bulan=tw.name)
         LEFT JOIN( 
            SELECT MONTH(date) AS name, COUNT(id) AS terlambat
            FROM presensi 
            WHERE YEAR(date) = '$tahun' AND cek_presensi = 2
            GROUP BY MONTH(date)
            ) 
        tl ON (bulan.id_bulan=tl.name) ORDER BY bulan.id_bulan ASC";
        return $this->db->query($query);
    }

    function getUser()
    {
        $query =
            "SELECT user_role.role AS role,COUNT(user.role_id) AS position 
         FROM user 
         JOIN user_role 
         ON user.role_id=user_role.id 
         GROUP BY (user_role.id)";
        return $this->db->query($query);
    }

    function getJumlahUser()
    {
        $query = "SELECT COUNT(user_id) as jml_user FROM user";
        return $this->db->query($query);
    }

    function getJumlahKegiatan()
    {
        $query = "SELECT COUNT(id) as jml_kegiatan FROM kegiatan";
        return $this->db->query($query);
    }

    function getJumlahPresensi()
    {
        $query = "SELECT COUNT(id) as jml_presensi FROM presensi";
        return $this->db->query($query);
    }

    function getJumlahSKP()
    {
        $query = "SELECT COUNT(id_skp) as jml_skp FROM skp";
        return $this->db->query($query);
    }
}
