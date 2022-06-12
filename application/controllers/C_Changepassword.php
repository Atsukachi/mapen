<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Changepassword extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Data', 'data');
    }

    public function index_get()
    {
        $email = $this->get('email');
        $user = $this->data->user_login($email);

        if ($email == '') {
            $hasil = $this->response(array('status' => 'fail'));
        } else {
            $hasil = $user;
        }

        $this->response($hasil->password,  RestController::HTTP_OK);
        return $email;
    }

    public function index_post()
    {
        $email = $this->post('email');
        $user = $this->data->user_login($email);
        $current_password = $this->input->post('current_password');
        $new_password1 = $this->input->post('new_password1');
        $new_password2 = $this->input->post('new_password2');

        if (password_verify($current_password, $user->password)) {
            if ($new_password1 == $new_password2) {
                $data =
                    [
                        'new_password'     => password_hash($new_password1, PASSWORD_DEFAULT),
                        'status'           => 'success'
                    ];
                $pass = $data['new_password'];
                $this->db->where('email', $email);
                $insert = $this->db->update('user', ['password' => $pass]);

                if ($insert) {
                    $this->response($data);
                } else {
                    $this->response(array('status' => 'fail'));
                }
            } else {
                $this->response(array('status' => 'fail'));
            }
        } else {
            $this->response(array('status' => 'fail'));
        }
    }
}
