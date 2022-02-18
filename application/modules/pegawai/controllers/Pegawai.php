<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No direct script access allowed');

// Export Excel File
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('M_Pegawai', 'pegawai');
	}

	public function index()
	{
		$this->load->helper('mapen_helper');
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['semuauser'] = $this->pegawai->getUserExport()->result_array();
		$data['title'] = "Halaman Presensi Pegawai";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pegawai/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function export()
	{
		if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
			redirect('pegawai/blocked');
		}
		$id = $this->input->post('user_id');
		$getall = $this->pegawai->getPresensiById($id)->result();
		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'User Name')
			->setCellValue('C1', 'Tanggal')
			->setCellValue('D1', 'Waktu')
			->setCellValue('E1', 'Riwayat')
			->setCellValue('F1', 'Status')
			->setCellValue('G1', 'Foto')
			->setCellValue('H1', 'Kerja')
			->setCellValue('I1', 'Latitude')
			->setCellValue('J1', 'Longitude')
			->setCellValue('K1', 'Cek Presensi');

		$kolom = 2;
		$nomor = 1;
		foreach ($getall as $ga) {
			$link = base_url('assets/images/presensi/' . $ga->foto);
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $ga->name)
				->setCellValue('C' . $kolom, date("Y-m-d", $ga->tanggal))
				->setCellValue('D' . $kolom, date("H:i:s", $ga->tanggal))
				->setCellValue('E' . $kolom, $ga->jenis_riwayat)
				->setCellValue('F' . $kolom, $ga->jenis_status)
				->setCellValue('G' . $kolom, '=Hyperlink("' . $link . '")')
				// ->setCellValue('G' . $kolom, '=Hyperlink("https://www.example.com/","Example")')
				// ->setCellValue('G' . $kolom, $ga->foto)
				->setCellValue('H' . $kolom, $ga->metode)
				->setCellValue('I' . $kolom, $ga->lat)
				->setCellValue('J' . $kolom, $ga->lng)
				->setCellValue('K' . $kolom, $ga->cek_presensi);

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
			header('Content-Disposition: attachment;filename="Export_Pegawai.xlsx"');
		} else {
			header('Content-Disposition: attachment;filename="Export_Pegawai_User_"' . $id . '".xlsx"');
		}
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_detail($id)
	{
		if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != '2') {
			redirect('pegawai/blocked');
		}
		$getall = $this->pegawai->getPresensiById($id)->result();
		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'User Name')
			->setCellValue('C1', 'Tanggal')
			->setCellValue('D1', 'Waktu')
			->setCellValue('E1', 'Riwayat')
			->setCellValue('F1', 'Status')
			->setCellValue('G1', 'Foto')
			->setCellValue('H1', 'Kerja')
			->setCellValue('I1', 'Latitude')
			->setCellValue('J1', 'Longitude')
			->setCellValue('K1', 'Cek Presensi');

		$kolom = 2;
		$nomor = 1;
		foreach ($getall as $ga) {
			$link = base_url('assets/images/presensi/' . $ga->foto);
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $ga->name)
				->setCellValue('C' . $kolom, date("Y-m-d", $ga->tanggal))
				->setCellValue('D' . $kolom, date("H:i:s", $ga->tanggal))
				->setCellValue('E' . $kolom, $ga->jenis_riwayat)
				->setCellValue('F' . $kolom, $ga->jenis_status)
				->setCellValue('G' . $kolom, '=Hyperlink("' . $link . '")')
				// ->setCellValue('G' . $kolom, '=Hyperlink("https://www.example.com/","Example")')
				// ->setCellValue('G' . $kolom, $ga->foto)
				->setCellValue('H' . $kolom, $ga->metode)
				->setCellValue('I' . $kolom, $ga->lat)
				->setCellValue('J' . $kolom, $ga->lng)
				->setCellValue('K' . $kolom, $ga->cek_presensi);

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
			header('Content-Disposition: attachment;filename="Export_Pegawai.xlsx"');
		} else {
			header('Content-Disposition: attachment;filename="Export_Pegawai_User_"' . $id . '".xlsx"');
		}
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function presensi()
	{
		$data['riwayat'] = $this->pegawai->getPresensi()->result_array();
		$data['kerja'] = $this->pegawai->getDataKerja()->result();
		$data['cek_presensi'] = $this->pegawai->getDataPresensiCek()->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Halaman Presensi Pegawai";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pegawai/presensi', $data);
		$this->load->view('templates/footer');
	}

	public function blocked()
	{
		$this->load->view('pegawai/blocked');
	}

	public function viewmarkerpegawai()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$data_pegawai = $this->db->get('presensi');

		$cek = $data_pegawai->row_array();

		if (!$this->input->is_ajax_request()) {
			$this->load->view('pegawai/blocked');
		} else {
			if ($cek['lat'] != null && $cek['lng'] != null) {
				$status = 'Success';
				$msg = $data_pegawai->result();
				$data_pegawai = $data_pegawai->result();
			} else {
				$status = 'Error';
				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Location not found!</div>');
				$msg = 'Alamat tidak ada!';
				$data_pegawai = null;
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg, 'data_pegawai' => $data_pegawai)));
		}
	}

	public function tambah($id_riwayat)
	{
		is_present_in();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Halaman Presensi Pegawai";
		$data['salam'] = $this->db->get('status')->result();
		$data['kerja'] = $this->pegawai->getDataKerja()->result();
		$data['presensi'] = $this->pegawai->getDataPresensi()->result_array();
		$data['presensi_cek'] = $this->pegawai->getDataCekPresensi($id_riwayat)->result_array();
		$data['riwayat'] = $this->pegawai->getStatusRiwayat($id_riwayat)->result_array();
		$data['riwayat_id'] = $this->pegawai->getRiwayatId($id_riwayat)->result_array();

		$this->load->view('Templates/header', $data);
		$this->load->view('Templates/topbar', $data);
		$this->load->view('Templates/sidebar', $data);
		$this->load->view('pegawai/tambah', $data);
		$this->load->view('Templates/footer', $data);

		if (isset($_POST['submit'])) {
			$user_id = $this->input->post('user_id');
			$tanggal = time();
			$jam_now = date("H:i:s", $tanggal);
			$salam = $data['salam'];
			$date = date("Y-m-d");
			$id_riwayat = $this->input->post('id_riwayat');
			$status = $this->input->post('status_id');
			$kerja = $this->input->post('kerja');
			$lat = $this->input->post('lat');
			$lng = $this->input->post('lng');
			$check = $this->input->post('check');
			$image = $this->input->post('image');
			$img = base64_decode($image);
			$filename = 'image_' . time() . '.png';
			file_put_contents(FCPATH . '/assets/images/presensi/' . $filename, $img);
			foreach ($salam as $s) :
				if ($status == $s->id_status) {
					if (empty($check)) {
						$cek_terlambat = date('H:i:s', strtotime($s->jam_datang . '+30 minute'));
						// var_dump($cek_terlambat);
						// die;
						if ($jam_now > $s->jam_datang && $jam_now < $cek_terlambat) {
							$data = array(
								'user_id' => $user_id,
								'tanggal' => $tanggal,
								'date' => $date,
								'riwayat' => $id_riwayat,
								'status' => $status,
								'foto' => '',
								'kerja' => $kerja,
								'lat' => $lat,
								'lng' => $lng,
								'cek_presensi' => 1
							);
						} else if ($jam_now > $cek_terlambat && $jam_now < $s->jam_pulang) {
							$data = array(
								'user_id' => $user_id,
								'tanggal' => $tanggal,
								'date' => $date,
								'riwayat' => $id_riwayat,
								'status' => $status,
								'foto' => '',
								'kerja' => $kerja,
								'lat' => $lat,
								'lng' => $lng,
								'cek_presensi' => 2
							);
							unlink(FCPATH . '/assets/images/presensi/' . $filename);
						}
					} else {
						$cek_terlambat = date('H:i:s', strtotime($s->jam_datang . '+30 minute'));
						if ($jam_now > $s->jam_datang && $jam_now < $cek_terlambat) {
							$data = array(
								'user_id' => $user_id,
								'tanggal' => $tanggal,
								'date' => $date,
								'riwayat' => $id_riwayat,
								'status' => $status,
								'foto' => $filename,
								'kerja' => $kerja,
								'lat' => $lat,
								'lng' => $lng,
								'cek_presensi' => 1
							);
						} else if ($jam_now > $cek_terlambat && $jam_now < $s->jam_pulang) {
							$data = array(
								'user_id' => $user_id,
								'tanggal' => $tanggal,
								'date' => $date,
								'riwayat' => $id_riwayat,
								'status' => $status,
								'foto' => $filename,
								'kerja' => $kerja,
								'lat' => $lat,
								'lng' => $lng,
								'cek_presensi' => 2
							);
						}
					}
				}
			endforeach;
			$this->db->insert('presensi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Present has been Added!</div>');
			redirect('pegawai');
		}
	}

	public function hapus_pegawai($id)
	{
		if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != 2) {
			redirect('pegawai/blocked');
		}

		$post = $this->db->get_where('presensi', ['id' => $id])->row_array();
		$hapus = $post['foto'];
		unlink(FCPATH . '/assets/document/images/presensi/' . $hapus);

		$delete = $this->pegawai->delete_pegawai($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kegiatan Harian has been Deleted!</div>');
		redirect(base_url('pegawai'));
	}

	public function detail($id)
	{
		is_history_in();
		$data['presensi_list'] = $this->pegawai->getPresensiById($id)->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Halaman Detail Riwayat";
		$data['list_presensi'] = $this->pegawai->getDataPresensi()->result_array();
		$data['get_jmlpresensi'] = $this->pegawai->getJumlahPresensiById($id)->result_array();
		$data['get_totalpresensi'] = $this->pegawai->getTotalPresensiById($id)->result_array();
		$data['get_tot'] = $this->pegawai->getTotalById($id)->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pegawai/detail', $data);
		$this->load->view('templates/footer_map', $data);
	}

	public function detailPresensi()
	{
		if ($this->session->userdata('role_id') != '1' && $this->session->userdata('role_id') != 2) {
			redirect('pegawai/blocked');
		}
		$id = $this->input->post('id');

		$config['upload_path']   = FCPATH . './assets/document/riwayat/';
		$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|csv|xlsx|xls|pptx|ppt|mp4|mpeg|mkv';
		$config['max_size']      = 102400;
		$config['encrypt_name']  = False;
		$config['file_name'] = url_title($this->input->post('file'));
		$this->upload->initialize($config);

		// File Upload
		if (!$this->upload->do_upload('file')) {
			$data = array(
				'riwayat_id' => $this->input->post('riwayat_id'),
				'jobdesk' => $this->input->post('jobdesk'),
				'deskripsi' => $this->input->post('deskripsi'),
				'user' => $this->input->post('user'),
				'tanggal' => $this->input->post('tanggal')
			);
			$this->db->where('id', $id);
			$this->db->update('riwayat', $data);
			// var_dump($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Riwayat Harian has been Update!</div>');
			redirect('riwayat');
		} else {
			$old_file = $this->input->post('file_old');
			// var_dump($old_file);

			if (!empty($old_file)) {
				unlink(FCPATH . './assets/document/riwayat/' . $old_file);
			}
			$new_file = $this->upload->data('file_name');
			// var_dump($new_file);
			$ext = pathinfo($new_file, PATHINFO_EXTENSION);

			if ($ext == "jpg" or $ext == "png" or $ext == "jpeg") {
				$this->file_categories = "1";
			} else if ($ext == "mp4" or $ext == "mpeg" or $ext == "mkv") {
				$this->file_categories = "2";
			} else if ($ext == "docx" or $ext == "doc") {
				$this->file_categories = "3";
			} else if ($ext == "xlsx" or $ext == "xls") {
				$this->file_categories = "4";
			} else if ($ext == "pptx" or $ext == "ppt") {
				$this->file_categories = "5";
			} else if ($ext == "pdf") {
				$this->file_categories = "6";
			} else {
				return $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Document Cannot be Added!</div>');
			}

			$ext_file = $this->file_categories;
			$data = array(
				'riwayat_id' => $this->input->post('riwayat_id'),
				'jobdesk' => $this->input->post('jobdesk'),
				'deskripsi' => $this->input->post('deskripsi'),
				'user' => $this->input->post('user'),
				'tanggal' => $this->input->post('tanggal'),
				'file' => $new_file,
				'file_categories' => $ext_file
			);
			$this->db->where('id', $id);
			$this->db->update('riwayat', $data);
			// var_dump($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Riwayat Harian has been Update!</div>');
			redirect('riwayat');
		}
	}
}
