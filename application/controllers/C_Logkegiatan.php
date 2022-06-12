<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Logkegiatan extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function data_get()
    {
        $id_user = $this->get("user_id");
        $data = $this->data->getLogKegiatan($id_user);

        $log = [];
        foreach ($data as $result) {
            $tgl = $result->tanggal / 1000;
            $date = date("Y-m-d", $tgl);
            $time = date("H:i:s", $tgl);
            $format_indo = tgl_indo($date);

            if ($result->skp == 0) {
                $result->nama_skp = "Tidak Dengan SKP";
            }
            $log[] = [
                'id'                => $result->id,
                'kegiatan_id'       => $result->kegiatan_id,
                'unitkerja'         => $result->unitkerja,
                'uraian'            => $result->uraian,
                'skp'               => $result->skp,
                'nama_unit_kerja'   => $result->nama_unit_kerja,
                'nama_skp'          => $result->nama_skp,
                'user'              => $result->user,
                'tanggal'           => $format_indo . ", " . $time,
                'date_created'      => $result->tanggal,
                'file'              => $result->file,
                'file_categories'   => $result->file_categories,
            ];
        }

        $this->response($log, 200);
    }

    public function index_get()
    {
        $id_user = $this->get('user_id');
        if ($id_user != null) {
            //Get Data SKP
            // $get_skp = $this->data->getSKP($id_user);

            //Get Data Unit Kerja
            // $get_unitkerja = $this->data->getUnitKerja();

            // Get Kode Kegiatan
            $kode = $this->data->getKegiatanKode($id_user);
            error_reporting(0);

            $hari = date('d');
            $bulan = date('m');
            $tahun = date('Y');
            $thn = substr($tahun, 2, 2);
            $code = "$kode->kegiatan_code";
            $kegiatan = $this->data->getLastKegiatan($hari, $bulan, $tahun, $code)->row_array();
            $nomorterakhir = $kegiatan['kegiatan_id'];
            $getdata = buatkode($nomorterakhir, $code . $hari . $bulan . $thn, 4);
            $data =  [
                'kodekegiatan' => $getdata
            ];

            $this->response($data,  RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'Failed', 502));
        }
    }

    public function index_post()
    {
        $id_user = $this->post('user');

        // Get Kode Kegiatan
        $kode = $this->data->getKegiatanKode($id_user);
        error_reporting(0);

        $hari = date('d');
        $bulan = date('m');
        $tahun = date('Y');
        $thn = substr($tahun, 2, 2);
        $code = "$kode->kegiatan_code";
        $kegiatan = $this->data->getLastKegiatan($hari, $bulan, $tahun, $code)->row_array();
        $nomorterakhir = $kegiatan['kegiatan_id'];
        $get_kodekeg = buatkode($nomorterakhir, $code . $hari . $bulan . $thn, 4);

        // Get ID Unit Kerja
        $unitkerja = $this->input->post('unitkerja');
        // $data_unitkerja = $this->data->getIdUnitKerja($unitkerja);

        // Get ID SKP
        $idskp = $this->input->post('skp');
        // $data_idskp = $this->data->getIdSKP($nama_skp, $id_user);

        $uraian = $this->input->post('uraian');
        $tanggal = (int) round(microtime(true) * 1000);
        $date_created = date("Y-m-d H:i:s", $tanggal / 1000);

        // Format tanggal yyyy-mm-dd h:i:s
        // $tanggal = time();
        // $jam_now = date("H:i:s", $tanggal);
        // $date = date("Y-m-d");

        if ($id_user == null) {
            $this->response(array('status' => 'Failed', 302));
        } else {
            $config['upload_path']      = FCPATH . './assets/document/kegiatan/';
            $config['allowed_types']    = 'jpg|png|jpeg|pdf|docx|doc|csv|xlsx|xls|pptx|ppt|mp4|mpeg|mkv|rar|zip';
            $config['max_size']         = '102400';

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $this->response(array('status' => 'Failed', 402));
            } else {
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
                    return $this->response(array('status' => 'File Not Found', 502));
                }
                $ext_file = $this->file_categories;

                $data =
                    [
                        'kegiatan_id'       => $get_kodekeg,
                        'unitkerja'         => $unitkerja,
                        'uraian'            => $uraian,
                        'skp'               => $idskp,
                        'user'              => $id_user,
                        'tanggal'           => $tanggal,
                        'date_created'      => $date_created,
                        'file'              => $files,
                        'file_categories'   => $ext_file
                    ];

                // $this->response($data);
                $insert = $this->db->insert('kegiatan', $data);
                if ($insert) {
                    $this->response($data, 200);
                } else {
                    $this->response(array('status' => 'Failed', 502));
                }
            }
        }
    }
}
