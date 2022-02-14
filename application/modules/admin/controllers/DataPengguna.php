<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPengguna extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('M_Pengguna', 'pengguna');
  }

  public function index()
  {
    $this->load->helper('mapen_helper');
    $data['title'] = "Halaman Data Pengguna";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    if ($this->session->userdata('role_id') != '1') {
      $this->db->where('role_id !=', 1);
    }
    $data['getuser'] = $this->db->get('user')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/pengguna/index');
    $this->load->view('templates/footer');
  }

  public function edit_pengguna($id)
  {
    is_user_in();
    $data['title'] = "Halaman Edit Data Pengguna";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['getuser'] = $this->pengguna->allPengguna()->result();
    $data['edit_id'] = $this->pengguna->getPenggunaId($id)->row();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/pengguna/edit_pengguna');
    $this->load->view('templates/footer');
  }

  public function update_pengguna()
  {
    $this->form_validation->set_rules('new_password1', 'New Password', 'trim|min_length[8]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'trim|min_length[8]|matches[new_password1]');
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $new_password = $this->input->post('new_password1');
    $oldpwd = $this->input->post('oldpwd');
    if ($new_password == '') {
      $passUpdate = $oldpwd;
    } else {
      $passUpdate = password_hash($new_password, PASSWORD_DEFAULT);
    }

    if ($this->form_validation->run() == TRUE) {
      $id = $this->input->post('id');

      $config['upload_path']   = FCPATH . './assets/images/users/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size']      = '5090';
      // $config['max_width']     = '1024';
      // $config['max_height']    = '768';
      $config['file_name']     = url_title($this->input->post('image'));
      // $filename = $this->upload->file_name;

      $this->upload->initialize($config);
      if (!$this->upload->do_upload('image')) {
        $data = array(
          'name' => $this->input->post('name'),
          'role_id' => $this->input->post('role_id'),
        );
        // var_dump($data);
        $this->db->set('password',  $passUpdate);
        $this->db->where('email', $this->input->post('email'));
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        User has been Update!
        </div>');
        redirect('admin/DataPengguna/');
      } else {
        $old_image = $this->input->post('image_old');
        // var_dump($old_image);
        if (!empty($old_image)) {
          unlink(FCPATH . './assets/images/users/' . $old_image);
        }
        $new_image = $this->upload->data('file_name');
        // var_dump($new_image);
        $data = array(
          'name' => $this->input->post('name'),
          'role_id' => $this->input->post('role_id'),
          'image' => $new_image
        );
        // var_dump($data);
        $this->db->set('password',  $passUpdate);
        $this->db->where('email', $this->input->post('email'));
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          User has been Update!
          </div>');
        redirect('admin/DataPengguna/');
      }
    }
  }

  public function hapus_pengguna($id)
  {
    $post = $this->db->get_where('user', ['user_id' => $id])->row_array();
    // Hapus keahlian
    $hps_k = $post['keahlian'];
    unlink(FCPATH . '/assets/document/users/' . $hps_k);

    // Hapus Foto
    $hps_f = $post['image'];
    unlink(FCPATH . '/assets/images/users/' . $hps_f);

    $this->pengguna->delete_user($id);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        User has been Deleted!
        </div>');
    redirect('admin/DataPengguna/');
  }
}
