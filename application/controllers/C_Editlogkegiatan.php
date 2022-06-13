<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Editlogkegiatan extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
    }

    public function index_get()
    {
        $id_user = $this->get('user_id');
        if ($id_user != null) {
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
        $id = $this->post('id');
        $unitkerja = $this->input->post('unitkerja');
        $user = $this->input->post('user');
        $skp = $this->input->post('skp');
        $uraian = $this->input->post('uraian');
        $tanggal = $this->input->post('tanggal');

        if ($id == null) {
            $this->response(array('status' => 'Failed', 302));
        } else {
            $config['upload_path']      = FCPATH . './assets/document/kegiatan/';
            $config['allowed_types']    = 'jpg|png|jpeg|pdf|docx|doc|csv|xlsx|xls|pptx|ppt|mp4|mpeg|mkv|rar|zip';
            $config['max_size']         = '20480';
            $config['file_name']        = url_title($this->input->post('keahlian'));

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('editfile')) {
                $queryFile = $this->data->getFileLogKegiatan($id);
                $oldfile = $queryFile->file;

                $ext_oldfile = pathinfo($oldfile, PATHINFO_EXTENSION);
                if ($ext_oldfile == "jpg" or $ext_oldfile == "png" or $ext_oldfile == "jpeg") {
                    $this->file_categories = "1";
                } else if ($ext_oldfile == "mp4" or $ext_oldfile == "mpeg" or $ext_oldfile == "mkv") {
                    $this->file_categories = "2";
                } else if ($ext_oldfile == "docx" or $ext_oldfile == "doc") {
                    $this->file_categories = "3";
                } else if ($ext_oldfile == "xlsx" or $ext_oldfile == "xls") {
                    $this->file_categories = "4";
                } else if ($ext_oldfile == "pptx" or $ext_oldfile == "ppt") {
                    $this->file_categories = "5";
                } else if ($ext_oldfile == "pdf") {
                    $this->file_categories = "6";
                } else if ($ext_oldfile == "rar" or $ext_oldfile == "zip") {
                    $this->file_categories = "7";
                } else {
                    return $this->response(array('status' => 'File Not Found', 502));
                }
                $ext = $this->file_categories;

                $data = array(
                    'id'                => $id,
                    'user'              => $user,
                    'unitkerja'         => $unitkerja,
                    'uraian'            => $uraian,
                    'skp'               => $skp,
                    'file'              => $oldfile,
                    'file_categories'   => $ext
                    // 'tanggal'           => $tanggal,
                    // 'date_created'      => $date_created
                );
                // $this->response($data, 200);

                $this->db->where('id', $id);
                $insert = $this->db->update('kegiatan', $data);

                if ($insert) {
                    $this->response($data, 200);
                } else {
                    $this->response(array('status' => 'Failed', 502));
                }
            } else {
                // new file upload
                $data2 = $this->upload->data();
                $newfile = $data2['file_name'];

                // old file from database
                $queryFile = $this->data->getFileLogKegiatan($id);
                $oldfile = $queryFile->file;

                if ($oldfile != null) {
                    $ext_oldfile = pathinfo($oldfile, PATHINFO_EXTENSION);
                    if ($ext_oldfile == "jpg" or $ext_oldfile == "png" or $ext_oldfile == "jpeg") {
                        unlink(FCPATH . '/assets/document/kegiatan/photo/' . $oldfile);
                    } else if ($ext_oldfile == "mp4" or $ext_oldfile == "mpeg" or $ext_oldfile == "mkv") {
                        unlink(FCPATH . '/assets/document/kegiatan/video/' . $oldfile);
                    } else if ($ext_oldfile == "docx" or $ext_oldfile == "doc") {
                        unlink(FCPATH . '/assets/document/kegiatan/word/' . $oldfile);
                    } else if ($ext_oldfile == "xlsx" or $ext_oldfile == "xls") {
                        unlink(FCPATH . '/assets/document/kegiatan/excel/' . $oldfile);
                    } else if ($ext_oldfile == "pptx" or $ext_oldfile == "ppt") {
                        unlink(FCPATH . '/assets/document/kegiatan/powerpoint/' . $oldfile);
                    } else if ($ext_oldfile == "pdf") {
                        unlink(FCPATH . '/assets/document/kegiatan/pdf/' . $oldfile);
                    } else if ($ext_oldfile == "rar" or $ext_oldfile == "zip") {
                        unlink(FCPATH . '/assets/document/kegiatan/library/' . $oldfile);
                    } else {
                        return $this->response(array('status' => 'File Not Found', 502));
                    }
                }

                if ($newfile != null) {
                    $ext_file = pathinfo($newfile, PATHINFO_EXTENSION);

                    if ($ext_file == "jpg" or $ext_file == "png" or $ext_file == "jpeg") {
                        $this->file_categories = "1";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/photo/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else if ($ext_file == "mp4" or $ext_file == "mpeg" or $ext_file == "mkv") {
                        $this->file_categories = "2";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/video/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else if ($ext_file == "docx" or $ext_file == "doc") {
                        $this->file_categories = "3";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/word/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else if ($ext_file == "xlsx" or $ext_file == "xls") {
                        $this->file_categories = "4";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/excel/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else if ($ext_file == "pptx" or $ext_file == "ppt") {
                        $this->file_categories = "5";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/powerpoint/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else if ($ext_file == "pdf") {
                        $this->file_categories = "6";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/pdf/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else if ($ext_file == "rar" or $ext_file == "zip") {
                        $this->file_categories = "7";
                        unlink(FCPATH . './assets/document/kegiatan/' . $newfile);
                        $move = FCPATH . '/assets/document/kegiatan/library/' . $newfile;
                        move_uploaded_file($_FILES["editfile"]['tmp_name'], $move);
                    } else {
                        return $this->response(array('status' => 'File Not Found', 502));
                    }

                    $ext = $this->file_categories;
                    $data = array(
                        'unitkerja'         => $unitkerja,
                        'uraian'            => $uraian,
                        'skp'               => $skp,
                        // 'tanggal'           => $tanggal,
                        // 'date_created'      => $date_created,
                        'file'              => $newfile,
                        'file_categories'   => $ext
                    );
                    // $this->response($data, 200);

                    $this->db->where('id', $id);
                    $update = $this->db->update('kegiatan', $data);

                    if ($update) {
                        $this->response($data, 200);
                    } else {
                        $this->response(array('status' => 'Failed', 502));
                    }
                }
            }
        }
    }
}
