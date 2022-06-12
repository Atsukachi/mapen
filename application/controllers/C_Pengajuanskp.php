<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Pengajuanskp extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
    }

    public function index_get()
    {
        $bulan = $this->data->getMonth();
        $this->response($bulan,  RestController::HTTP_OK);
    }

    public function index_post()
    {
        $id_user = $this->post('user_id');
        $bulan_nama = $this->input->post('bulan');
        $bulan = $this->data->getIdMonth($bulan_nama);
        $tahun = $this->input->post('tahun');
        $nama_skp = $this->input->post('nama_skp');

        $data =
            [
                'user'          => $id_user,
                'bulan'         => $bulan->id_bulan,
                'tahun'         => $tahun,
                'nama_skp'      => $nama_skp,
                'nilai'         => 0,
                'cek_validasi'  => 0
            ];

        // echo json_encode($this->response($data));
        $insert = $this->db->insert('skp', $data);

        if ($insert) {
            $this->response($data);
        } else {
            $this->response(array('status' => 'fail'));
        }
    }
}
