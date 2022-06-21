<?php

use phpDocumentor\Reflection\DocBlock\Tags\Return_;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Data extends CI_Model
{
	// Login
	public function user_login($email)
	{
		$query = "SELECT * FROM `user` WHERE `user`.`email`= '$email'";
		return $this->db->query($query)->row();
	}

	// SKP
	public function getMonth()
	{
		$query = "SELECT * FROM `bulan`";
		return $this->db->query($query)->result();
	}

	public function getIdMonth($bulan_nama)
	{
		$query = "SELECT `id_bulan` FROM `bulan` WHERE `nama_bulan` = '$bulan_nama'";
		return $this->db->query($query)->row();
	}

	public function getSKP($id_user)
	{
		$query = "SELECT `skp`.*, `bulan`.`nama_bulan`,
					(SELECT COUNT(id) FROM `kegiatan`
	 				WHERE `kegiatan`.`user` = $id_user 
	 				AND `kegiatan`.`skp` = `skp`.`id_skp`) AS jml_kegiatan 
					FROM `skp`
					LEFT JOIN `bulan`
					on `bulan`.`id_bulan` = `skp`.`bulan`
					WHERE `skp`.`user` = $id_user
					ORDER BY `skp`.`bulan` DESC";
		return $this->db->query($query)->result();
	}

	public function getSKPbyID($id_user)
	{
		$bulan = date('m');
		$tahun = date('Y');
		$query = "SELECT `skp`.`id_skp`, `skp`.`nama_skp`
					FROM `skp`
					LEFT JOIN `bulan`
					on `bulan`.`id_bulan` = `skp`.`bulan`
					WHERE `skp`.`user` = $id_user AND `skp`.`bulan` = $bulan AND `skp`.`tahun` = $tahun";
		return $this->db->query($query)->result();
	}

	// Profil
	public function getImageProfile($user_id)
	{
		$query = "SELECT `image` FROM `user` WHERE `user_id` = '$user_id'";
		return $this->db->query($query)->row();
	}

	public function getKeahlianProfile($user_id)
	{
		$query = "SELECT `keahlian` FROM `user` WHERE `user_id` = '$user_id'";
		return $this->db->query($query)->row();
	}

	// Log Kegiatan
	public function getUnitKerja()
	{
		$query = "SELECT * FROM `unit_kerja`";
		return $this->db->query($query)->result();
	}

	public function getFileLogKegiatan($id)
	{
		$query = "SELECT `file` FROM `kegiatan` WHERE `id` = '$id'";
		return $this->db->query($query)->row();
	}

	public function getIdUnitKerja($unitkerja)
	{
		$query = "SELECT `id_unit_kerja` FROM `unit_kerja` WHERE `nama_unit_kerja` = '$unitkerja'";
		return $this->db->query($query)->row();
	}

	public function getLogKegiatan($id_user)
	{
		$query = "SELECT `kegiatan`.*, `file`.`extension`, `unit_kerja`.`nama_unit_kerja`, `skp`.`nama_skp`
					FROM `kegiatan`
					LEFT JOIN `file`
					on `file`.`file_id` = `kegiatan`.`file_categories`
					LEFT JOIN `skp`
					on `skp`.`id_skp` = `kegiatan`.`skp`
					LEFT JOIN `unit_kerja`
					on `unit_kerja`.`id_unit_kerja` = `kegiatan`.`unitkerja`
					WHERE `kegiatan`.`user` = $id_user
					ORDER BY `kegiatan`.`date_created` DESC";
		return $this->db->query($query)->result();
	}

	public function getIdSKP($nama_skp, $id_user)
	{
		$query = "SELECT `id_skp` FROM `skp` WHERE `nama_skp` = '$nama_skp' AND `user` = '$id_user'";
		return $this->db->query($query)->row();
	}

	public function getKegiatanKode($id_user)
	{
		$query = "SELECT `kegiatancode`.`kegiatan_code`,`user`.* 
			FROM `kegiatancode` LEFT JOIN `user` ON `user`.`role_id` = `kegiatancode`.`id` 
			WHERE `user`.`user_id` = '" . $id_user . "'";
		return $this->db->query($query)->row();
	}

	public function getLastKegiatan($hari, $bulan, $tahun, $code)
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		$this->db->select('kegiatan.kegiatan_id');
		$this->db->from('kegiatan');
		$this->db->join('user', 'kegiatan.user = user.user_id', 'left');
		$this->db->join('kegiatancode', 'user.role_id = kegiatancode.id', 'left');
		$this->db->order_by('kegiatan.kegiatan_id', 'DESC');
		$this->db->where('kegiatancode.kegiatan_code=', $code);
		$this->db->where('DAY(tanggal)', $hari);
		$this->db->where('MONTH(tanggal)', $bulan);
		$this->db->where('YEAR(tanggal)', $tahun);
		$this->db->limit(1);
		return $this->db->get();
	}

	// Presensi
	public function getMetodeKerja()
	{
		$query = "SELECT * FROM `kerja`";
		return $this->db->query($query)->result();
	}

	public function getRiwayat($getdata)
	{
		$this->load->helper('mapen_helper');
		$query = "SELECT `riwayat`.*, `status`.*
					FROM `riwayat`
					LEFT JOIN `status`
					on `riwayat`.`status_id` = `status`.`id_status`
					WHERE `status`.`status` = '$getdata'";
		return $this->db->query($query)->result();
	}

	public function getDataPresensi($id_user, $riwayat)
	{
		$tgl = date("Y-m-d");
		$this->load->helper('mapen_helper');
		$query = "SELECT `riwayat`.*, `status`.*, 
        	(SELECT COUNT(`id`) FROM `presensi` WHERE `user_id` = '$id_user' AND `date` = '$tgl' AND `presensi`.`riwayat` = `riwayat`.`id_riwayat`) as `cek_p`,
        	(SELECT COUNT(`riwayat`) FROM `presensi` WHERE `user_id` = '$id_user' AND `date` = '$tgl' AND `riwayat`.`riwayat` = 'Jam Datang') as `p_cek`
        	FROM `riwayat` LEFT JOIN `status` ON `riwayat`.`status_id` = `status`.`id_status` WHERE `status`.`status` = '" . salam_jam() . "' AND `riwayat`.`riwayat` = '$riwayat'";
		return $this->db->query($query)->row();
	}

	public function getStatus()
	{
		$query = "SELECT * FROM `status`";
		return $this->db->query($query)->result();
	}

	public function getPresensi($user_id)
	{
		$query = "SELECT `presensi`.*
					FROM `presensi`
					LEFT JOIN `riwayat`
					on `presensi`.`riwayat` = `riwayat`.`id_riwayat`
					LEFT JOIN `status`
					on `presensi`.`status` = `status`.`id_status`
					LEFT JOIN `kerja`
					on `presensi`.`kerja` = `kerja`.`id_kerja`
					WHERE `presensi`.`user_id` = $user_id
					ORDER BY `presensi`.`date` DESC";
		return $this->db->query($query)->result();
	}

	public function getRiwayatPresensi($id_riwayat)
	{
		$query = "SELECT * FROM `riwayat` WHERE `riwayat`.`id_riwayat` = $id_riwayat";
		return $this->db->query($query)->row();
	}

	public function getStatusPresensi($id_status)
	{
		$query = "SELECT * FROM `status` WHERE `status`.`id_status` = $id_status";
		return $this->db->query($query)->row();
	}

	public function getKerjaPresensi($id_kerja)
	{
		$query = "SELECT * FROM `kerja` WHERE `kerja`.`id_kerja` = $id_kerja";
		return $this->db->query($query)->row();
	}

	//    public function get_kelas_online($nisn){
	// 		$query = "SELECT `user`.*,`matpel`.*,`kelas_matpel`.*,`guru`.* 
	// 					FROM `user` 
	// 					LEFT JOIN `siswa` 
	// 					on `siswa`.`user_id`=`user`.`id`
	// 					LEFT JOIN `guru`
	// 					on `guru`.`id_guru`=`siswa`.`wali_kelas` 
	// 					LEFT JOIN `kelas_matpel` 
	// 					on `siswa`.`kelas_id`=`kelas_matpel`.`kelas_id` 
	// 					LEFT JOIN `matpel` 
	// 					on `kelas_matpel`.`matpel_id`=`matpel`.`id_matpel` 
	//                     Where `siswa`.`nisn` = $nisn 
	//         ";
	//         return $this->db->query($query)->result();
	// 	}
	//    public function get_tugas($kelas_id,$matpel_id){
	// 		$query = "SELECT `m_mapel`.*,`tugas`.*
	// 					FROM `m_mapel`
	// 					LEFT JOIN `tugas` on `tugas`.`m_mapelId`=`m_mapel`.`id_m_mapel` 
	// 					LEFT JOIN `kelas` on `kelas`.`id_kelas`=`m_mapel`.`kelas_id`
	// 					LEFT JOIN `matpel` on `matpel`.`id_matpel`=`m_mapel`.`mapel_id`
	// 					where `m_mapel`.`kelas_id`=$kelas_id and `m_mapel`.`mapel_id`=$matpel_id;
	//        			";
	//         return $this->db->query($query)->result();
	// 	}
	//    public function get_absensi($nisn){
	// 		$query = "SELECT `absensi`.*,`matpel`.*,
	// 					(SELECT COUNT(id) FROM `absensi_siswa`
	// 					WHERE `absensi_siswa`.`nisn` = $nisn 
	// 					AND `absensi`.`id_absen` = `absensi_siswa`.`absen_id`) AS ada
	// 					FROM `absensi` 
	// 					LEFT JOIN `m_mapel`
	// 					ON `m_mapel`.`id_m_mapel`=`absensi`.`m_mapel_id`
	// 					LEFT JOIN `matpel`
	// 					ON `m_mapel`.`mapel_id`=`matpel`.`id_matpel`
	// 					WHERE `absensi_active`=1
	// 					GROUP BY `absensi`.`id_absen`
	// 					HAVING `ada`=0";
	//         return $this->db->query($query)->result();
	// 	}
}
