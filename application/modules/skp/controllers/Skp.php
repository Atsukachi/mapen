<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Export Excel File
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Skp extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('M_Skp', 'skp');
  }

  public function index()
  {
    $data['title'] = "Halaman Tabel SKP";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['semuauser'] = $this->skp->getUserExport()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('skp/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function nilai($id)
  {
    $data['title'] = "Halaman Nilai SKP";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['nilai'] = $this->skp->getNilaiSKP($id)->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('skp/nilai', $data);
    $this->load->view('templates/footer', $data);
  }

  public function minta_nilai()
  {
    $id = $this->input->post('id_skp');
    $data = array(
      'nilai' => $this->input->post('nilai'),
      'cek_validasi' => 1,
    );
    $this->db->where('id_skp', $id);
    $this->db->update('skp', $data);
    // var_dump($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kegiatan Harian has been Update!</div>');
    redirect('skp');
  }

  public function detail($id)
  {
    is_history_in();
    $data['title'] = "Halaman Detail Tabel SKP";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['skp'] = $this->skp->getDataSKPById($id)->result();
    $data['bulan'] = $this->db->get('bulan')->result_array();
    $data['semuauser'] = $this->skp->getUserExport()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('skp/detail', $data);
    $this->load->view('templates/footer', $data);
  }

  public function export()
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
      redirect('skp/blocked');
    }
    $id = $this->input->post('user_id');
    $getall = $this->skp->getSKPById($id)->result();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'User Name')
      ->setCellValue('C1', 'Bulan')
      ->setCellValue('D1', 'Tahun')
      ->setCellValue('E1', 'Nama SKP')
      ->setCellValue('F1', 'Nilai')
      ->setCellValue('G1', 'Validasi');

    $kolom = 2;
    $nomor = 1;
    foreach ($getall as $ga) {
      $valid = $ga->cek_validasi;
      if ($valid == 0) {
        $validasi = 'Belum Mengajukan Nilai';
      } else if ($valid == 1) {
        $validasi = 'Sedang Proses';
      } else if ($valid == 2) {
        $validasi = 'Sudah Selesai';
      }
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $ga->name)
        ->setCellValue('C' . $kolom, $ga->nama_bulan)
        ->setCellValue('D' . $kolom, $ga->tahun)
        ->setCellValue('E' . $kolom, $ga->nama_skp)
        ->setCellValue('F' . $kolom, $ga->nilai)
        ->setCellValue('G' . $kolom, $validasi);

      $kolom++;
      $nomor++;
    }
    foreach (range('A', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
      $spreadsheet->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
    }
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    if ($id == '') {
      header('Content-Disposition: attachment;filename="Export_SKP.xlsx"');
    } else {
      header('Content-Disposition: attachment;filename="Export_SKP_User_"' . $id . '".xlsx"');
    }
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function export_detail($id)
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
      redirect('skp/blocked');
    }
    $getall = $this->skp->getSKPById($id)->result();
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'User Name')
      ->setCellValue('C1', 'Bulan')
      ->setCellValue('D1', 'Tahun')
      ->setCellValue('E1', 'Nama SKP')
      ->setCellValue('F1', 'Nilai')
      ->setCellValue('G1', 'Validasi');

    $kolom = 2;
    $nomor = 1;
    foreach ($getall as $ga) {
      $valid = $ga->cek_validasi;
      if ($valid == 0) {
        $validasi = 'Belum Mengajukan Nilai';
      } else if ($valid == 1) {
        $validasi = 'Sedang Proses';
      } else if ($valid == 2) {
        $validasi = 'Sudah Selesai';
      }
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $ga->name)
        ->setCellValue('C' . $kolom, $ga->nama_bulan)
        ->setCellValue('D' . $kolom, $ga->tahun)
        ->setCellValue('E' . $kolom, $ga->nama_skp)
        ->setCellValue('F' . $kolom, $ga->nilai)
        ->setCellValue('G' . $kolom, $validasi);

      $kolom++;
      $nomor++;
    }
    foreach (range('A', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
      $spreadsheet->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
    }
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    if ($id == '') {
      header('Content-Disposition: attachment;filename="Export_SKP.xlsx"');
    } else {
      header('Content-Disposition: attachment;filename="Export_SKP_User_"' . $id . '".xlsx"');
    }
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function pengajuan()
  {
    $data['bulan'] = $this->db->get('bulan')->result();
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['title'] = "Halaman Tambah Kegiatan";

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('skp/pengajuan', $data);
    $this->load->view('templates/footer', $data);
  }

  public function addSKP()
  {
    $jumlah = count($this->input->post('skp'));
    for ($i = 0; $i < $jumlah; $i++) {
      $data = array(
        'user' => $this->input->post('user_id')[$i],
        'bulan' => $this->input->post('bulan')[$i],
        'tahun' => $this->input->post('tahun')[$i],
        'nama_skp' => $this->input->post('skp')[$i]
      );
      // var_dump($data);
      $this->db->insert('skp', $data);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan SKP has been Added!</div>');
    redirect('skp/index');
  }

  public function hapus_skp($id)
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
      redirect('skp/blocked');
    }
    $delete = $this->skp->delete_skp($id);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengajuan SKP has been Deleted!</div>');
    redirect(base_url('skp'));
  }

  public function blocked()
  {
    $this->load->view('skp/blocked');
  }

  public function edit_skp($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['skp_edit'] = $this->skp->getDataEditSKP($id)->row_array();
    $data['title'] = "Halaman Edit Kegiatan";
    $data['bulan'] = $this->db->get('bulan')->result();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('skp/edit_skp', $data);
    $this->load->view('templates/footer', $data);
  }

  public function editSKP()
  {
    $id = $this->input->post('id_skp');
    $data = array(
      'user' => $this->input->post('user_id'),
      'bulan' => $this->input->post('bulan'),
      'tahun' => $this->input->post('tahun'),
      'nama_skp' => $this->input->post('skp'),
    );
    $this->db->where('id_skp', $id);
    $this->db->update('skp', $data);
    // var_dump($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kegiatan Harian has been Update!</div>');
    redirect('skp');
  }
}
