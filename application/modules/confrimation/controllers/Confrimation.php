<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Export Excel File
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Confrimation extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('M_Confrimation', 'confrim');
  }

  public function nilai_skp()
  {
    $data['title'] = "Halaman Tabel SKP";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['nilai_skp'] = $this->confrim->getSKP_Nilai()->result();
    $data['bulan'] = $this->db->get('bulan')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('confrimation/nilai_skp', $data);
    $this->load->view('templates/footer', $data);
  }

  public function detail_nilai($id)
  {
    $data['title'] = "Halaman Detail Nilai SKP";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['detail_nilai'] = $this->confrim->getById_NilaiSkp($id)->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('confrimation/detail_nilai', $data);
    $this->load->view('templates/footer', $data);
  }

  public function validasi_nilai()
  {
    $id = $this->input->post('id_skp');
    $data = array(
      'nilai' => $this->input->post('nilai'),
      'cek_validasi' => 2,
    );
    $this->db->where('id_skp', $id);
    $this->db->update('skp', $data);
    // var_dump($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Validation Score SKP has been Update!</div>');
    redirect('confrimation/nilai_skp');
  }
}
