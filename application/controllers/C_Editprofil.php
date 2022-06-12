<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Editprofil extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
    }

    public function foto_post()
    {
        $user_id = $this->post('user_id');

        if ($user_id != null) {
            $file_path = FCPATH . './assets/images/users/';
            $config['upload_path'] = $file_path;
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '20480';

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->response(array('status' => 'Failed', 502));
            } else {
                $image = $_FILES['image']['name'];
                $queryImage = $this->data->getImageProfile($user_id);
                $oldimage = $queryImage->image;

                if ($oldimage != 'user.jpg') {
                    $old_file_path = FCPATH . './assets/images/users/' . $oldimage;
                    unlink($old_file_path);

                    $data = array(
                        'image' => $image
                    );

                    $this->db->where('user_id', $user_id);
                    $insert = $this->db->update('user', $data);

                    if ($insert) {
                        $this->response($data, 200);
                    } else {
                        $this->response(array('status' => 'Failed', 502));
                    }
                } else {
                    $data = array(
                        'image' => $image
                    );

                    $this->db->where('user_id', $user_id);
                    $insert = $this->db->update('user', $data);

                    if ($insert) {
                        $this->response($data, 200);
                    } else {
                        $this->response(array('status' => 'Failed', 502));
                    }
                }
            }
        }
    }

    public function index_post()
    {
        $user_id = $this->post('user_id');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telephone = $this->input->post('telephone');

        if ($user_id != null) {
            $file_path = FCPATH . './assets/document/users/';
            $config['upload_path'] = $file_path;
            $config['allowed_types'] = 'docx|doc|pdf';
            $config['max_size'] = '20480';

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('keahlian')) {
                $data = array(
                    'email' => $email,
                    'alamat' => $alamat,
                    'telephone' => '62' . $telephone
                );

                $this->db->where('user_id', $user_id);
                $insert = $this->db->update('user', $data);

                if ($insert) {
                    $this->response($data, 200);
                } else {
                    $this->response(array('status' => 'Failed', 502));
                }
            } else {
                $keahlian = $_FILES['keahlian']['name'];
                $queryFile = $this->data->getKeahlianProfile($user_id);
                $oldfile = $queryFile->keahlian;

                if ($oldfile != null) {
                    $old_keahlian_path = FCPATH . './assets/document/users/' . $oldfile;
                    unlink($old_keahlian_path);

                    if ($alamat == null && $telephone == null) {
                        $data = array(
                            'email' => $email,
                            'keahlian' => $keahlian
                        );
                    } else if ($alamat == null && $telephone != null) {
                        $data = array(
                            'email' => $email,
                            'telephone' => '62' . $telephone,
                            'keahlian' => $keahlian
                        );
                    } else if ($alamat != null && $telephone == null) {
                        $data = array(
                            'email' => $email,
                            'alamat' => $alamat,
                            'keahlian' => $keahlian
                        );
                    } else {
                        $data = array(
                            'email' => $email,
                            'alamat' => $alamat,
                            'telephone' => '62' . $telephone,
                            'keahlian' => $keahlian
                        );
                    }
                    $this->db->where('user_id', $user_id);
                    $insert = $this->db->update('user', $data);

                    if ($insert) {
                        $this->response($data, 200);
                    } else {
                        $this->response(array('status' => 'Failed', 502));
                    }
                } else {
                    if ($alamat == null && $telephone == null) {
                        $data = array(
                            'email' => $email,
                            'keahlian' => $keahlian
                        );
                    } else if ($alamat == null && $telephone != null) {
                        $data = array(
                            'email' => $email,
                            'telephone' => '62' . $telephone,
                            'keahlian' => $keahlian
                        );
                    } else if ($alamat != null && $telephone == null) {
                        $data = array(
                            'email' => $email,
                            'alamat' => $alamat,
                            'keahlian' => $keahlian
                        );
                    } else {
                        $data = array(
                            'email' => $email,
                            'alamat' => $alamat,
                            'telephone' => '62' . $telephone,
                            'keahlian' => $keahlian
                        );
                    }

                    $this->db->where('user_id', $user_id);
                    $insert = $this->db->update('user', $data);

                    if ($insert) {
                        $this->response($data, 200);
                    } else {
                        $this->response(array('status' => 'Failed', 502));
                    }
                }
            }
        }
    }
}
