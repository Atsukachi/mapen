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

	// public function register()
	// {
	// 	// json response array
	// 	$response = array("error" => FALSE);
	// 	$insertArray = array();

	// 	// menerima parameter POST ( name, email, password dan repassword )
	// 	$name = $_POST['name'];
	// 	$email = $_POST['email'];
	// 	$password = $_POST['password'];
	// 	$password2 = $_POST['password2'];

	// 	$user = $this->db->get_where('user', ['email' => $email])->num_rows();
	// 	if ($user == 0) {
	// 		if ($password == $password2) {
	// 			$response["error"] = FALSE;
	// 			$response["error_msg"] = "Register berhasil";
	// 			$response["user"]["name"] = $name;
	// 			$response["user"]["email"] = $email;
	// 			$response["user"]["image"] = "user.jpg";
	// 			$response["user"]["password"] = password_hash($password, PASSWORD_DEFAULT);
	// 			$response["user"]["role_id"] = 3;
	// 			echo json_encode($response, JSON_PRETTY_PRINT);

	// 			array_push($insertArray, $response['user']);
	// 			$this->db->insert_batch('user', $insertArray);
	// 		} else {
	// 			$response["error"] = TRUE;
	// 			$response["error_msg"] = "Register gagal, password salah";
	// 			echo json_encode($response, JSON_PRETTY_PRINT);
	// 		}
	// 	} else {
	// 		$response["error"] = TRUE;
	// 		$response["error_msg"] = "User telah ada dengan email " . $email;
	// 		echo json_encode($response, JSON_PRETTY_PRINT);
	// 	}
	// }
}
