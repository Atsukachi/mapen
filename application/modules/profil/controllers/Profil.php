<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Profile";
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		// modules::run('templates/Templates');
		// $this->load->view('header', $data);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('profil/profil', $data);
		$this->load->view('templates/footer');
	}

	public function edit_profil()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'FULL NAME', 'trim|required');
		$this->form_validation->set_rules('tel', 'TELEPHONE', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('profil/edit', $data);
			$this->load->view('templates/footer');
		} else {
			redirect('profil');
		}
	}

	public function download_file($id)
	{
		$this->load->helper('download');
		$data = $this->db->get_where('user', ['user_id' => $id])->row();
		$doc = $data->keahlian;
		$path = FCPATH . '/assets/document/users/' . $doc;

		$download = file_get_contents($path);
		force_download($doc, $download);
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$email = $this->input->post('email');


		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('name', 'FULL NAME', 'trim|required');

			$config['allowed_types'] = 'jpg|png|jpeg|gif|doc|docx|pdf';
			$config['max_size']      = '10240';
			$config['encrypt_name']  = False;

			$this->load->library('upload', $config);

			if (!empty($_FILES['file'])) {
				$config['file_name'] = url_title($this->input->post('file'));
				$config['upload_path']   = FCPATH . './assets/document/users/';
				$this->upload->initialize($config);

				$this->upload->do_upload('file');
				$data_file = $this->upload->data();

				$keahlian = $data_file['file_name'];
				// var_dump($keahlian);
			}


			if (!empty($_FILES['image'])) {
				$config['file_name']     = url_title($this->input->post('image'));
				$config['upload_path']   = FCPATH . './assets/images/users/';
				$this->upload->initialize($config);

				$this->upload->do_upload('image');
				$data_image = $this->upload->data();
				$image = $data_image['file_name'];
				// var_dump($image);

				$old_image = $this->input->post('image_old');
				$old_file = $this->input->post('file_old');

				if (!empty($image) && !empty($keahlian)) {
					if ($this->form_validation->run()) {
						$data = array(
							'name' => $this->input->post('name'),
							'alamat' => $this->input->post('alamat'),
							'telephone' => '62' . $this->input->post('telephone'),
							'image' => $image,
							'keahlian' => $keahlian
						);
						// var_dump($data);
						$this->db->where('email', $email);
						$this->db->update('user', $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil has been Update!</div>');
						redirect('profil');
					}
				}

				if (!empty($image) && empty($keahlian)) {
					if ($old_image != 'user.jpg') {
						unlink(FCPATH . './assets/images/users/' . $old_image);
					} else {
						$ori = FCPATH . '/assets/images/user.jpg';
						$to = FCPATH . '/assets/images/users/user.jpg';
						copy($ori, $to);
					}
					if ($this->form_validation->run()) {
						$data = array(
							'name' => $this->input->post('name'),
							'alamat' => $this->input->post('alamat'),
							'telephone' => '62' . $this->input->post('telephone'),
							'image' => $image,
							'keahlian' => $old_file
						);
						// var_dump($data);
						$this->db->where('email', $email);
						$this->db->update('user', $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil has been Update!</div>');
						redirect('profil');
					}
				} else if (empty($keahlian) && !empty($image)) {
					if ($this->form_validation->run()) {
						$data = array(
							'name' => $this->input->post('name'),
							'alamat' => $this->input->post('alamat'),
							'telephone' => '62' . $this->input->post('telephone'),
							'image' => $old_image,
							'keahlian' => $old_file
						);
						// var_dump($data);
						$this->db->where('email', $email);
						$this->db->update('user', $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil has been Update!</div>');
						redirect('profil');
					}
				}

				if (!empty($keahlian) && empty($image)) {
					if (!empty($old_file)) {
						unlink(FCPATH . './assets/document/users/' . $old_file);
					}
					if ($this->form_validation->run()) {
						$data = array(
							'name' => $this->input->post('name'),
							'alamat' => $this->input->post('alamat'),
							'telephone' => '62' . $this->input->post('telephone'),
							'image' => $old_image,
							'keahlian' => $keahlian
						);
						// var_dump($data);
						$this->db->where('email', $email);
						$this->db->update('user', $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil has been Update!</div>');
						redirect('profil');
					}
				} else if (empty($image) && !empty($keahlian)) {
					if ($this->form_validation->run()) {
						$data = array(
							'name' => $this->input->post('name'),
							'alamat' => $this->input->post('alamat'),
							'telephone' => '62' . $this->input->post('telephone'),
							'image' => $old_image,
							'keahlian' => $old_file
						);
						// var_dump($data);
						$this->db->where('email', $email);
						$this->db->update('user', $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil has been Update!</div>');
						redirect('profil');
					}
				} else if (empty($file) && empty($image)) {
					if ($this->form_validation->run()) {
						$data = array(
							'name' => $this->input->post('name'),
							'alamat' => $this->input->post('alamat'),
							'telephone' => '62' . $this->input->post('telephone'),
							'image' => $old_image,
							'keahlian' => $old_file
						);
						// var_dump($data);
						$this->db->where('email', $email);
						$this->db->update('user', $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil has been Update!</div>');
						redirect('profil');
					}
				}
			}
		}
	}

	public function changepassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'trim|required|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('profil/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Current Password!
                </div>');
				redirect('profil/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Current Password cant be same!
                    </div>');
					redirect('profil/changepassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password has been Change!
                    </div>');
					redirect('profil');
				}
			}
		}
	}
}
