<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Nilaiskp extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
    }

    public function index_post()
    {
        $id_skp = $this->post('id_skp');
        $nilai = $this->input->post('nilai');

        $data =
            [
                'nilai'         => $nilai,
                'cek_validasi'  => 1
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
