<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('M_Admin', 'admin');
	}
	public function index()
	{
		$data['title'] = "Halaman admin";
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['get_user'] = $this->admin->getUser()->result();
		$data['get_jmluser'] = $this->admin->getJumlahUser()->result_array();
		$data['get_jmlkegiatan'] = $this->admin->getJumlahKegiatan()->result_array();
		$data['get_jmlpresensi'] = $this->admin->getJumlahPresensi()->result_array();
		$data['get_jmlskp'] = $this->admin->getJumlahSKP()->result_array();
		$data['presensi_hari'] = $this->admin->getPresensibyHari()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}
	public function role()
	{
		$data['title'] = "Role User";
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		if ($this->session->userdata('role_id') != '1') {
			$this->db->where('id !=', 1);
		}
		$data['role'] = $this->db->get('user_role')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/role');
		$this->load->view('templates/footer');
	}
	public function addrole()
	{

		$this->db->insert('user_role', ['role' => $this->input->post('role')]);
		$this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">New Role Added !!!</div>');
		redirect('admin/role');
	}
	public function delete_role($id)
	{
		if ($this->session->userdata('role_id') != '1') {
			if ($id == 1) {
				redirect('pegawai/blocked');
			}
		}
		$delete = $this->admin->Mdelete_role($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Delete Role Success !!!</div>');
		redirect('admin/role');
	}
	public function roleAccess($role_id)
	{
		$data['title'] = "Role User";
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		if ($this->session->userdata('role_id') != '1') {
			if ($role_id == 1) {
				redirect('pegawai/blocked');
			}
		}
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/role_access');
		$this->load->view('templates/footer');
	}
	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];
		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success"
		role="alert">Access Role Change !!!</div>');
	}
}
