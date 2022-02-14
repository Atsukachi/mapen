<?php
defined('BASEPATH') or exit('No direct access allowed');

class M_Table extends CI_Model
{
    // Riwayat
    public function getDataRiwayat()
    {
        $query = "SELECT `riwayat`.*,`status`.*
        FROM `riwayat`
        LEFT JOIN `status` ON `riwayat`.`status_id`=`status`.`id_status`";
        return $this->db->query($query)->result();
    }
    public function delete_riwayat($id)
    {
        $this->db->where('id_riwayat', $id);
        return $this->db->delete('riwayat');
    }
    public function ubah_riwayat($data)
    {
        $this->db->where('id_riwayat', $this->input->post('id_riwayat'));
        return $this->db->update('riwayat', $data);
    }
    public function getDataEditRiwayat()
    {
        $id_riwayat = $this->input->post('id_riwayat');
        $query = "SELECT `riwayat`.*,`status`.*
        FROM `riwayat`
        LEFT JOIN `status` ON `riwayat`.`status_id`=`status`.`id_status`
        WHERE `riwayat`.`id_riwayat`=.$id_riwayat";
        return $this->db->query($query)->row_array();
    }

    // Status
    public function getDataStatus()
    {
        return $this->db->get('status');
    }
    public function delete_status($id)
    {
        $this->db->where('id_status', $id);
        return $this->db->delete('status');
    }
    public function Medit_status($data)
    {
        $this->db->where('id_status', $this->input->post('id_status'));
        return $this->db->update('status', $data);
    }

    // Unit Kerja
    public function getDataUnitKerja()
    {
        return $this->db->get('unit_kerja');
    }
    public function delete_unit_kerja($id)
    {
        $this->db->where('id_unit_kerja', $id);
        return $this->db->delete('unit_kerja');
    }
    public function Medit_unit_kerja($data)
    {
        $this->db->where('id_unit_kerja', $this->input->post('id_unit_kerja'));
        return $this->db->update('unit_kerja', $data);
    }

    // Kode
    public function getDataKode()
    {
        return $this->db->get('kegiatancode');
    }
    public function delete_kode($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kegiatancode');
    }
    public function Medit_kode($data)
    {
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('kegiatancode', $data);
    }

    // File
    public function getDataFile()
    {
        return $this->db->get('file');
    }
    public function delete_file($file_id)
    {
        $this->db->where('file_id', $file_id);
        return $this->db->delete('file');
    }
    public function Medit_file($data)
    {
        $this->db->where('file_id', $this->input->post('file_id'));
        return $this->db->update('file', $data);
    }
}
