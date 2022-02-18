<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Table extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // $this->load->library('form_validation');
        // $this->load->library('session');
        $this->load->model('M_Table', 'table');
    }

    // Riwayat
    public function riwayat()
    {
        $data['riwayat'] = $this->table->getDataRiwayat();
        $data['status'] = $this->db->get('status')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Halaman Riwayat Presensi";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('table/riwayat', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_riwayat()
    {
        $this->db->insert(
            'riwayat',
            [
                'riwayat' => $this->input->post('riwayat'),
                'status_id' => $this->input->post('status_id')
            ]
        );
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">New Riwayat Presensi Added !!!</div>');
        redirect('table/riwayat');
    }
    public function hapus_riwayat($id)
    {
        $delete = $this->table->delete_riwayat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Delete Riwayat Presensi Success !!!</div>');
        redirect('table/riwayat');
    }
    public function edit_riwayat()
    {
        $data = array(
            'riwayat' => $this->input->post('riwayat'),
            'status_id' => $this->input->post('status_id')
        );
        $this->table->ubah_riwayat($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
        role="alert">Edit Riwayat Presensi Success !!!</div>');
        redirect('table/riwayat');
    }

    // Status
    public function status()
    {
        $data['status'] = $this->table->getDataStatus()->result();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = "Halaman Status Presensi";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('table/status', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_status()
    {

        $this->db->insert(
            'status',
            [
                'status' => $this->input->post('status'),
                'jam_datang' => $this->input->post('jam_datang'),
                'jam_pulang' => $this->input->post('jam_pulang')
            ]
        );
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">New Status Presensi Added !!!</div>');
        redirect('table/status');
    }
    public function hapus_status($id)
    {
        $delete = $this->table->delete_status($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Delete Status Presensi Success !!!</div>');
        redirect('table/status');
    }
    public function edit_status()
    {
        $data = array(
            'status' => $this->input->post('status'),
            'jam_datang' => $this->input->post('jam_datang'),
            'jam_pulang' => $this->input->post('jam_pulang')
        );
        $this->table->Medit_status($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Edit Status Presensi Success !!!</div>');
        redirect('table/status');
    }

    // Unit Kerja
    public function unit_kerja()
    {
        $data['unitkerja'] = $this->table->getDataUnitKerja()->result();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = "Halaman Status Presensi";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('table/unit_kerja', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_unit_kerja()
    {

        $this->db->insert('unit_kerja', ['nama_unit_kerja' => $this->input->post('unit_kerja')]);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">New Unit Kerja Added !!!</div>');
        redirect('table/unit_kerja');
    }
    public function hapus_unit_kerja($id)
    {
        $delete = $this->table->delete_unit_kerja($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Delete Unit Kerja Success !!!</div>');
        redirect('table/unit_kerja');
    }
    public function edit_unit_kerja()
    {
        $data = array(
            'nama_unit_kerja' => $this->input->post('unit_kerja')
        );
        $this->table->Medit_unit_kerja($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Edit Unit Kerja Success !!!</div>');
        redirect('table/unit_kerja');
    }

    // Kode
    public function kode()
    {
        $data['kode'] = $this->table->getDataKode()->result();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = "Halaman Kode Presensi";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('table/kode', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_kode()
    {

        $this->db->insert('riwayatcode', ['riwayat_code' => $this->input->post('riwayat_code')]);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">New Kode Presensi Added !!!</div>');
        redirect('table/kode');
    }
    public function hapus_kode($id)
    {
        $delete = $this->table->delete_kode($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Delete Kode Presensi Success !!!</div>');
        redirect('table/kode');
    }
    public function edit_kode()
    {
        $data = array(
            'riwayat_code' => $this->input->post('riwayat_code')
        );
        $this->table->Medit_kode($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
        role="alert">Edit Kode Presensi Success !!!</div>');
        redirect('table/kode');
    }

    // File
    public function file()
    {
        $data['file'] = $this->table->getDataFile()->result();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = "Halaman File Presensi";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('table/file', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_file()
    {

        $this->db->insert('file', ['extension' => $this->input->post('extension')]);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">New File Presensi Added !!!</div>');
        redirect('table/file');
    }
    public function hapus_file($file_id)
    {
        $delete = $this->table->delete_file($file_id);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Delete File Presensi Success !!!</div>');
        redirect('table/file');
    }
    public function edit_file()
    {
        $data = array(
            'extension' => $this->input->post('extension')
        );
        $this->table->Medit_file($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success"
        role="alert">Edit File Presensi Success !!!</div>');
        redirect('table/file');
    }
}
