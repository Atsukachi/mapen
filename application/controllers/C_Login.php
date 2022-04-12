<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class C_Login extends RestController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Data', 'data');
	}

	public function index_post()
	{
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$user = $this->data->user_login($email);

		if ($user) {
			if ($user->role_id == 3) {
				if (password_verify($password, $user->password)) {
					$this->response(
						[
							'error' => false,
							'message' => 'exist',
							'user_id' => $user->user_id,
							'name' => $user->name,
							'email' => $user->email,
							'alamat' => $user->alamat,
							'telephone' => $user->telephone,
							'image' => $user->image,
							'keahlian' => $user->keahlian,
							'role_id' => $user->role_id
						],
						RestController::HTTP_OK
					);
				} else {
					$this->response(
						[
							'error' => true,
							'message' => 'failed'
						],
						401
					);
				}
			} else {
				$this->response(
					[
						'error' => true,
						'message' => 'failed'
					],
					401
				);
			}
		} else {
			$this->response(
				[
					'error' => true,
					'message' => 'failed'
				],
				401
			);
		}
	}
}
