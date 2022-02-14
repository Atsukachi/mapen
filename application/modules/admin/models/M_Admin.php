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

    // function getPenjualanEvent()
    // {
    //     $tahun = date("Y");
    //     $query = "SELECT id,bulan as bln,event from bulan 
    //     LEFT JOIN( 
    //         SELECT MONTH(tgl_event) AS name, COUNT(category_id) AS event 
    //         FROM event 
    //         WHERE YEAR(tgl_event) = '$tahun'
    //         GROUP BY MONTH(tgl_event)
    //         ) 
    //     evt ON (bulan.id=evt.name) ORDER BY bulan.id ASC";
    //     return $this->db->query($query);
    // }
    // function getPenjualanKategori()
    // {
    //     $tahun = date("Y");
    //     $query =
    //         "SELECT id,bulan,webinar,lomba,workshop from bulan 
    //      LEFT JOIN( 
    //         SELECT MONTH(tgl_event) AS tanggal, 
    //         COUNT(IF(category_id = 1, category_id, null)) as webinar, 
    //         COUNT(IF(category_id = 2, category_id, null)) as lomba, 
    //         COUNT(IF(category_id = 3, category_id, null)) as workshop 
    //         FROM event 
    //         WHERE YEAR(tgl_event) = '$tahun'
    //         GROUP BY MONTH(tgl_event)) 
    //      evt ON (bulan.id=evt.tanggal) 
    //      ORDER BY bulan.id ASC";
    //     return $this->db->query($query);
    // }
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
    // function getJumlahEvent()
    // {
    //     $query =
    //         "SELECT COUNT(id) as jml_event FROM event";
    //     return $this->db->query($query);
    // }
    // function getJumlahBlog(){
    //     $query = 
    //     "SELECT COUNT(id) as jml_blog FROM blog";
    // return $this->db->query($query);
    // }
}
