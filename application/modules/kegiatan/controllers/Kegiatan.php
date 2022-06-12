<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Export Excel File
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kegiatan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('M_Kegiatan', 'kegiatan');
  }

  public function index()
  {
    $data['title'] = "Halaman Kegiatan Harian";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['semuauser'] = $this->kegiatan->getUserExport()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kegiatan', $data);
    $this->load->view('templates/footer', $data);
  }

  public function detail_kegiatan($id)
  {
    is_history_in();
    $data['unit_kerja'] = $this->db->get_where('unit_kerja')->result_array();
    $data['semuauser'] = $this->kegiatan->getUserExport()->result_array();
    $data['keg'] = $this->kegiatan->getDataKegiatanById($id)->result();
    $data['title'] = "Halaman Detail Tabel Kegiatan";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kegiatan/detail', $data);
    $this->load->view('templates/footer', $data);
  }

  public function export()
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
      redirect('kegiatan/blocked');
    }
    $id = $this->input->post('user_id');
    $getall = $this->kegiatan->getKegiatanById($id)->result();
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Kegiatan ID')
      ->setCellValue('C1', 'Unit Kerja')
      ->setCellValue('D1', 'Uraian')
      ->setCellValue('E1', 'SKP')
      ->setCellValue('F1', 'User')
      ->setCellValue('G1', 'Tanggal')
      ->setCellValue('H1', 'Waktu')
      ->setCellValue('I1', 'File')
      ->setCellValue('J1', 'Kategori');

    $kolom = 2;
    $nomor = 1;
    foreach ($getall as $ga) {
      $link = base_url('assets/document/kegiatan/' . $ga->file);
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $ga->kegiatan_id)
        ->setCellValue('C' . $kolom, $ga->nama_unit_kerja)
        ->setCellValue('D' . $kolom, $ga->uraian)
        ->setCellValue('E' . $kolom, $ga->nama_skp)
        ->setCellValue('F' . $kolom, $ga->name)
        ->setCellValue('G' . $kolom, date("Y-m-d", $ga->tanggal))
        ->setCellValue('H' . $kolom, date("H:i:s", $ga->tanggal))
        ->setCellValue('I' . $kolom, '=Hyperlink("' . $link . '")')
        ->setCellValue('J' . $kolom, $ga->extension);

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
      header('Content-Disposition: attachment;filename="Export_Kegiatan.xlsx"');
    } else {
      header('Content-Disposition: attachment;filename="Export_Kegiatan_User_"' . $id . '".xlsx"');
    }
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function export_detail($id)
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
      redirect('kegiatan/blocked');
    }
    $getall = $this->kegiatan->getKegiatanById($id)->result();
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Kegiatan ID')
      ->setCellValue('C1', 'Unit Kerja')
      ->setCellValue('D1', 'Uraian')
      ->setCellValue('E1', 'SKP')
      ->setCellValue('F1', 'User')
      ->setCellValue('G1', 'Tanggal')
      ->setCellValue('H1', 'Waktu')
      ->setCellValue('I1', 'File')
      ->setCellValue('J1', 'Kategori');

    $kolom = 2;
    $nomor = 1;
    foreach ($getall as $ga) {
      $link = base_url('assets/document/kegiatan/' . $ga->file);
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $ga->kegiatan_id)
        ->setCellValue('C' . $kolom, $ga->nama_unit_kerja)
        ->setCellValue('D' . $kolom, $ga->uraian)
        ->setCellValue('E' . $kolom, $ga->nama_skp)
        ->setCellValue('F' . $kolom, $ga->name)
        ->setCellValue('G' . $kolom, date("Y-m-d", $ga->tanggal))
        ->setCellValue('H' . $kolom, date("H:i:s", $ga->tanggal))
        ->setCellValue('I' . $kolom, '=Hyperlink("' . $link . '")')
        ->setCellValue('J' . $kolom, $ga->extension);

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
      header('Content-Disposition: attachment;filename="Export_Kegiatan.xlsx"');
    } else {
      header('Content-Disposition: attachment;filename="Export_Kegiatan_User_"' . $id . '".xlsx"');
    }
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function tambah_kegiatan()
  {
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['title'] = "Halaman Tambah Kegiatan";
    $data['skp'] = $this->kegiatan->getDataSKP()->result_array();
    $data['unit_kerja'] = $this->db->get_where('unit_kerja')->result_array();

    $kode = $this->kegiatan->getKegiatanKode();
    error_reporting(0);

    $hari = date('d');
    $bulan = date('m');
    $tahun = date('Y');
    $thn = substr($tahun, 2, 2);
    $code = "$kode->kegiatan_code";
    $kegiatan = $this->kegiatan->getLastKegiatan($hari, $bulan, $tahun, $code)->row_array();
    $nomorterakhir = $kegiatan['kegiatan_id'];
    $kegiatan_id = buatkode($nomorterakhir, $code . $hari . $bulan . $thn, 3);
    $data['kegiatan_id'] = $kegiatan_id;

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kegiatan/tambah_kegiatan', $data);
    $this->load->view('templates/footer', $data);
  }

  public function addKegiatan()
  {
    $data = array();

    // Looping all files
    foreach ($_FILES['files']['name'] as $i => $val) {
      if (!empty($_FILES['files']['name'][$i])) {

        // Define new $_FILES array - $_FILES['file']
        $_FILES['file']['name'] = $_FILES['files']['name'][$i];
        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
        $_FILES['file']['size'] = $_FILES['files']['size'][$i];

        // Set preference
        $config['upload_path']   = FCPATH . './assets/document/kegiatan/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|csv|xlsx|xls|pptx|ppt|mp4|mpeg|mkv|rar|zip';
        $config['max_size']      = 102400;
        $config['encrypt_name']  = false;
        $config['file_name']     = $_FILES['file']['name'];

        // Load upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // File upload
        if ($this->upload->do_upload('file')) {
          // Get data about the file
          $data2 = $this->upload->data();
          $files = $data2['file_name'];
          $ext = pathinfo($files, PATHINFO_EXTENSION);
          if ($ext == "jpg" or $ext == "png" or $ext == "jpeg") {
            $this->file_categories = "1";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/photo/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else if ($ext == "mp4" or $ext == "mpeg" or $ext == "mkv") {
            $this->file_categories = "2";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/video/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else if ($ext == "docx" or $ext == "doc") {
            $this->file_categories = "3";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/word/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else if ($ext == "xlsx" or $ext == "xls") {
            $this->file_categories = "4";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/excel/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else if ($ext == "pptx" or $ext == "ppt") {
            $this->file_categories = "5";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/powerpoint/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else if ($ext == "pdf") {
            $this->file_categories = "6";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/pdf/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else if ($ext == "rar" or $ext == "zip") {
            $this->file_categories = "7";
            unlink(FCPATH . './assets/document/kegiatan/' . $files);
            $move = FCPATH . '/assets/document/kegiatan/library/' . $files;
            move_uploaded_file($_FILES["file"]['tmp_name'], $move);
          } else {
            return $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Document Cannot be Added!</div>');
          }
          $ext_file = $this->file_categories;
        }
        $contoh = $_POST['uraian'][0];
        $find = array("<p>", "</p>");
        $result_uraian = str_replace($find, "", $contoh);

        $data[$i] = array(
          'kegiatan_id' => $_POST['kegiatan_id'][0],
          'unitkerja' => $_POST['unit_kerja'][0],
          'uraian' => $result_uraian,
          'skp' => $_POST['skp_id'][0],
          'user' => $_POST['user'][0],
          'tanggal' => $_POST['tanggal'][0],
          'date_created' => $_POST['date_created'][0],
          'file' => $files,
          'file_categories' => $ext_file
        );
      }
    }

    // var_dump($data);
    $this->db->insert_batch('kegiatan', $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kegiatan Harian has been Added!</div>');
    redirect('kegiatan');
  }

  public function hapus_kegiatan($id)
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != 2) {
      redirect('kegiatan/blocked');
    }
    $post = $this->db->get_where('kegiatan', ['id' => $id])->row_array();
    $hapus = $post['file'];
    $ext = pathinfo($hapus, PATHINFO_EXTENSION);
    if ($ext == "jpg" or $ext == "png" or $ext == "jpeg") {
      unlink(FCPATH . '/assets/document/kegiatan/photo/' . $hapus);
    } else if ($ext == "mp4" or $ext == "mpeg" or $ext == "mkv") {
      unlink(FCPATH . '/assets/document/kegiatan/video/' . $hapus);
    } else if ($ext == "docx" or $ext == "doc") {
      unlink(FCPATH . '/assets/document/kegiatan/word/' . $hapus);
    } else if ($ext == "xlsx" or $ext == "xls") {
      unlink(FCPATH . '/assets/document/kegiatan/excel/' . $hapus);
    } else if ($ext == "pptx" or $ext == "ppt") {
      unlink(FCPATH . '/assets/document/kegiatan/powerpoint/' . $hapus);
    } else if ($ext == "pdf") {
      unlink(FCPATH . '/assets/document/kegiatan/pdf/' . $hapus);
    } else if ($ext == "rar" or $ext == "zip") {
      unlink(FCPATH . '/assets/document/kegiatan/library/' . $hapus);
    } else {
      return $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Document Cannot Found!</div>');
    }
    $delete = $this->kegiatan->delete_kegiatan($id);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kegiatan Harian has been Deleted!</div>');
    redirect(base_url('kegiatan'));
  }

  public function blocked()
  {
    $this->load->view('kegiatan/blocked');
  }

  public function edit_kegiatan($id)
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != 2) {
      redirect('kegiatan/blocked');
    }
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['kegiatan_edit'] = $this->kegiatan->getDataEditKegiatan($id)->row();
    $data['title'] = "Halaman Edit Kegiatan";
    $data['file'] = $this->db->get('file')->result_array();
    $data['unit_kerja'] = $this->db->get_where('unit_kerja')->result();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kegiatan/edit_kegiatan', $data);
    $this->load->view('templates/footer', $data);
  }

  public function editKegiatan()
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != 2) {
      redirect('kegiatan/blocked');
    }
    $id = $this->input->post('id');

    $datetime = $this->input->post('datetime');
    $date_created = str_replace("T", " ", $datetime);
    // var_dump($date_created);

    date_default_timezone_set("Asia/Jakarta");
    $date = new DateTimeImmutable($date_created);
    $timemilis = (int) ($date->getTimestamp() . $date->format('v'));
    // var_dump($timemilis);

    $config['upload_path']   = FCPATH . './assets/document/kegiatan/';
    $config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|csv|xlsx|xls|pptx|ppt|mp4|mpeg|mkv|rar|zip';
    $config['max_size']      = 102400;
    $config['encrypt_name']  = False;
    $config['file_name']     = url_title($this->input->post('file'));
    $this->upload->initialize($config);

    // File Upload
    if (!$this->upload->do_upload('file')) {
      $data = array(
        'kegiatan_id' => $this->input->post('kegiatan_id'),
        'unitkerja' => $this->input->post('unit_kerja'),
        'uraian' => $this->input->post('uraian'),
        'user' => $this->input->post('user'),
        'tanggal' => $timemilis,
        'date_created' => $date_created
      );
      $this->db->where('id', $id);
      $this->db->update('kegiatan', $data);
      // var_dump($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kegiatan Harian has been Update!</div>');
      redirect('kegiatan');
    } else {
      $old_file = $this->input->post('file_old');
      // var_dump($old_file);
      $ext = pathinfo($old_file, PATHINFO_EXTENSION);

      if (!empty($old_file)) {
        if ($ext == "jpg" or $ext == "png" or $ext == "jpeg") {
          unlink(FCPATH . '/assets/document/kegiatan/photo/' . $old_file);
        } else if ($ext == "mp4" or $ext == "mpeg" or $ext == "mkv") {
          unlink(FCPATH . '/assets/document/kegiatan/video/' . $old_file);
        } else if ($ext == "docx" or $ext == "doc") {
          unlink(FCPATH . '/assets/document/kegiatan/word/' . $old_file);
        } else if ($ext == "xlsx" or $ext == "xls") {
          unlink(FCPATH . '/assets/document/kegiatan/excel/' . $old_file);
        } else if ($ext == "pptx" or $ext == "ppt") {
          unlink(FCPATH . '/assets/document/kegiatan/powerpoint/' . $old_file);
        } else if ($ext == "pdf") {
          unlink(FCPATH . '/assets/document/kegiatan/pdf/' . $old_file);
        } else if ($ext == "rar" or $ext == "zip") {
          unlink(FCPATH . '/assets/document/kegiatan/library/' . $old_file);
        } else {
          return $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Document Cannot be Added!</div>');
        }
      }

      $new_file = $this->upload->data('file_name');
      // var_dump($new_file);
      $ext = pathinfo($new_file, PATHINFO_EXTENSION);

      if ($ext == "jpg" or $ext == "png" or $ext == "jpeg") {
        $this->file_categories = "1";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/photo/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else if ($ext == "mp4" or $ext == "mpeg" or $ext == "mkv") {
        $this->file_categories = "2";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/video/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else if ($ext == "docx" or $ext == "doc") {
        $this->file_categories = "3";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/word/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else if ($ext == "xlsx" or $ext == "xls") {
        $this->file_categories = "4";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/excel/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else if ($ext == "pptx" or $ext == "ppt") {
        $this->file_categories = "5";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/powerpoint/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else if ($ext == "pdf") {
        $this->file_categories = "6";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/pdf/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else if ($ext == "rar" or $ext == "zip") {
        $this->file_categories = "7";
        unlink(FCPATH . './assets/document/kegiatan/' . $new_file);
        $move = FCPATH . '/assets/document/kegiatan/library/' . $new_file;
        move_uploaded_file($_FILES["file"]['tmp_name'], $move);
      } else {
        return $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Document Cannot be Added!</div>');
      }

      $ext_file = $this->file_categories;

      $data = array(
        'kegiatan_id' => $this->input->post('kegiatan_id'),
        'unitkerja' => $this->input->post('unit_kerja'),
        'uraian' => $this->input->post('uraian'),
        'user' => $this->input->post('user'),
        'tanggal' => $timemilis,
        'date_created' => $date_created,
        'file' => $new_file,
        'file_categories' => $ext_file
      );

      $this->db->where('id', $id);
      $this->db->update('kegiatan', $data);
      // var_dump($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kegiatan Harian has been Update!</div>');
      redirect('kegiatan');
    }
  }

  public function download_file($id)
  {
    if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
      redirect('kegiatan/blocked');
    }
    $this->load->helper('download');
    $data = $this->kegiatan->getDataEditKegiatan($id)->row();
    $doc = $data->file;
    $ext = pathinfo($doc, PATHINFO_EXTENSION);
    if ($ext == "jpg" or $ext == "png" or $ext == "jpeg") {
      $path = FCPATH . '/assets/document/kegiatan/photo/' . $doc;
    } else if ($ext == "mp4" or $ext == "mpeg" or $ext == "mkv") {
      $path = FCPATH . '/assets/document/kegiatan/video/' . $doc;
    } else if ($ext == "docx" or $ext == "doc") {
      $path = FCPATH . '/assets/document/kegiatan/word/' . $doc;
    } else if ($ext == "xlsx" or $ext == "xls") {
      $path = FCPATH . '/assets/document/kegiatan/excel/' . $doc;
    } else if ($ext == "pptx" or $ext == "ppt") {
      $path = FCPATH . '/assets/document/kegiatan/powerpoint/' . $doc;
    } else if ($ext == "pdf") {
      $path = FCPATH . '/assets/document/kegiatan/pdf/' . $doc;
    } else if ($ext == "rar" or $ext == "zip") {
      $path = FCPATH . '/assets/document/kegiatan/library/' . $doc;
    } else {
      return $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Document Cannot be Added!</div>');
    }
    $download = file_get_contents($path);
    force_download($doc, $download);
  }
}
