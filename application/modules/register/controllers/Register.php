<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('profil');
		}

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email has already use !'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'min_length' => 'Password min 8 Character !'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password]', [
			'matches' => 'Password dont match !',
			'min_length' => 'Password min 8 Character !'
		]);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Register Member";
			$this->load->view('templates/layout/headerL', $data);
			$this->load->view('register/register', $data);
			$this->load->view('templates/layout/footerL');
		} else {
			$email = $this->input->post('email', true);
			$ori = FCPATH . '/assets/images/user.jpg';
			$to = FCPATH . '/assets/images/users/user.jpg';
			copy($ori, $to);
			echo 'Data Berhasil Disimpan';
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($email),
				'image' => 'user.jpg',
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 3,
			];

			$this->db->insert('user', $data);

			$this->session->set_flashdata('message', '<br>
			<div class="alert alert-success text-center alert-dismissible fade show rounded" role="alert">
			Your account has been created. Please <strong>log in</strong> !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>	');
			redirect('login');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('login');
		}
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[8]|matches[password2]',
			array(
				'matches' => 'Password dont match!',
				'min_length' => 'Password min 8 Character'
			)
		);
		$this->form_validation->set_rules(
			'password2',
			'Password',
			'required|trim|min_length[8]|matches[password1]',
			array(
				'min_length' => 'Password min 8 Character'
			)
		);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/layout/headerL', $data);
			$this->load->view('register/changepassword', $data);
			$this->load->view('templates/layout/footerL');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<br>
				<div class="alert alert-success text-center alert-dismissible fade show rounded" role="alert">
				Your password has been changed !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}
	}
}
