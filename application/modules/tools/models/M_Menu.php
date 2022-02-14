<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Menu extends CI_Model
{
    public function Mdelete_menu($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_menu');
    }
    public function Medit_menu($data)
    {
        $this->db->where('id',$this->input->post('id'));
        return $this->db->update('user_menu',$data);
    }
    public function getSubMenu(){
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";
        return $this->db->query($query)->result_array();
        // $this->db->select('user_sub_menu.*, user_menu.menu');
        // $this->db->from('user_sub_menu');
		// $this->db->join('user_menu','user_sub_menu.menu_id = user_menu.id');
        // return $this->db->get();
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
		$this->db->join('user_menu','user_sub_menu.menu_id = user_menu.id');
        return $this->db->get();
    }
    public function ubah_submenu($data)
    {
        $this->db->where('id',$this->input->post('id'));
        return $this->db->update('user_sub_menu',$data);
    }
}