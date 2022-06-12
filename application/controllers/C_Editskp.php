<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Editskp extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
    }

    public function index_post()
    {
        $id_skp = $this->post('id_skp');
        $bulan = $this->input->post('bulan');
        $idbulan = $this->data->getIdMonth($bulan);
        $tahun = $this->input->post('tahun');
        $nama_skp = $this->input->post('nama_skp');

        $data =
            [
                'bulan'         => $idbulan->id_bulan,
                'tahun'         => $tahun,
                'nama_skp'      => $nama_skp
            ];
        $this->db->where('id_skp', $id_skp);
        $insert = $this->db->update('skp', $data);

        if ($insert) {
            $this->response($data);
        } else {
            $this->response(array('status' => 'fail'));
        }
    }
}
