<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Presensi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function metodekerja_get()
    {
        $data = $this->data->getMetodeKerja();
        $this->response($data, 200);
    }

    public function waktu_get()
    {
        $id_user = $this->get('user_id');
        $riwayat = $this->get('riwayat');
        $data = $this->data->getDataPresensi($id_user, $riwayat);
        $this->response($data, 200);
    }

    public function data_get()
    {
        $user_id = $this->get("user_id");
        $data = $this->data->getPresensi($user_id);

        $log = [];
        foreach ($data as $result) {
            $id_riwayat = $result->riwayat;
            $cekriwayat = $this->data->getRiwayatPresensi($id_riwayat);

            $id_status = $result->status;
            $cekstatus = $this->data->getStatusPresensi($id_status);

            $id_kerja = $result->kerja;
            $cekkerja = $this->data->getKerjaPresensi($id_kerja);

            $log[] = [
                'id'            => $result->id,
                'user_id'       => $result->user_id,
                'tanggal'       => $result->tanggal,
                'date'          => $result->date,
                'riwayat'       => $cekriwayat->riwayat,
                'foto'          => $result->foto,
                'status'        => $cekstatus->status,
                'kerja'         => $cekkerja->metode,
                'lat'           => $result->lat,
                'lng'           => $result->lng,
                'cek_presensi'  => $result->cek_presensi
            ];
        }

        $this->response($log, 200);
    }

    public function index_post()
    {
        $user_id = $this->post('user_id');
        $riwayat = $this->input->post('riwayat');
        $status = $this->input->post('status');
        $salam = $this->data->getStatus();
        $kerja = $this->input->post('kerja');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $tanggal = time();
        $jam_now = date("H:i:s", $tanggal);
        $date = date("Y-m-d");

        if ($user_id != null) {
            $file_path = FCPATH . './assets/images/presensi/';
            $config['upload_path'] = $file_path;
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '20480';

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            foreach ($salam as $s) :
                if ($status == $s->id_status) {
                    if (!$this->upload->do_upload('image')) {
                        $cek_terlambat = date('H:i:s', strtotime($s->jam_datang . '+30 minute'));
                        if ($jam_now > $s->jam_datang && $jam_now < $cek_terlambat) {
                            $data =
                                [
                                    'user_id'       => $user_id,
                                    'riwayat'       => $riwayat,
                                    'status'        => $status,
                                    'kerja'         => $kerja,
                                    'tanggal'       => $tanggal,
                                    'foto'          => '',
                                    'date'          => $date,
                                    'lat'           => $lat,
                                    'lng'           => $lng,
                                    'cek_presensi'  => 1
                                ];
                            $this->response($data);
                            // $insert = $this->db->insert('kegiatan', $data);
                            // if ($insert) {
                            //     $this->response($data, 200);
                            // } else {
                            //     $this->response(array('status' => 'Failed', 502));
                            // }
                        } else if ($jam_now > $cek_terlambat && $jam_now < $s->jam_pulang) {
                            $data =
                                [
                                    'user_id'       => $user_id,
                                    'riwayat'       => $riwayat,
                                    'status'        => $status,
                                    'kerja'         => $kerja,
                                    'tanggal'       => $tanggal,
                                    'foto'          => '',
                                    'date'          => $date,
                                    'lat'           => $lat,
                                    'lng'           => $lng,
                                    'cek_presensi'  => 2
                                ];
                            $this->response($data);
                            // $insert = $this->db->insert('kegiatan', $data);
                            // if ($insert) {
                            //     $this->response($data, 200);
                            // } else {
                            //     $this->response(array('status' => 'Failed', 502));
                            // }
                        }
                    } else {
                        $datafoto = $this->upload->data();
                        $foto = $datafoto['file_name'];

                        $cek_terlambat = date('H:i:s', strtotime($s->jam_datang . '+30 minute'));
                        if ($jam_now > $s->jam_datang && $jam_now < $cek_terlambat) {
                            $data =
                                [
                                    'user_id'       => $user_id,
                                    'riwayat'       => $riwayat,
                                    'status'        => $status,
                                    'kerja'         => $kerja,
                                    'tanggal'       => $tanggal,
                                    'foto'          => $foto,
                                    'date'          => $date,
                                    'lat'           => $lat,
                                    'lng'           => $lng,
                                    'cek_presensi'  => 1
                                ];
                            $this->response($data);
                            // $insert = $this->db->insert('kegiatan', $data);
                            // if ($insert) {
                            //     $this->response($data, 200);
                            // } else {
                            //     $this->response(array('status' => 'Failed', 502));
                            // }
                        } else if ($jam_now > $cek_terlambat && $jam_now < $s->jam_pulang) {
                            $data =
                                [
                                    'user_id'       => $user_id,
                                    'riwayat'       => $riwayat,
                                    'status'        => $status,
                                    'kerja'         => $kerja,
                                    'tanggal'       => $tanggal,
                                    'foto'          => $foto,
                                    'date'          => $date,
                                    'lat'           => $lat,
                                    'lng'           => $lng,
                                    'cek_presensi'  => 2
                                ];
                            $this->response($data);
                            // $insert = $this->db->insert('kegiatan', $data);
                            // if ($insert) {
                            //     $this->response($data, 200);
                            // } else {
                            //     $this->response(array('status' => 'Failed', 502));
                            // }
                        }
                    }
                }
            endforeach;
        }
    }
}
