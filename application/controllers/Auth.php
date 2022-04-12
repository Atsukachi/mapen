<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function login()
	{
		// json response array
		$response = array("error" => FALSE);

		// menerima parameter POST ( email dan password )
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user = $this->db->get_where('user', ['email' => $email])->result();

		if (!empty($email) && !empty($password)) {
			if ($user) {
				// get user dengan cek password
				if (password_verify($password, $user['password'])) {
					// user ditemukan
					$response["error"] = FALSE;
					$response["error_msg"] = "Login berhasil";
					$response["user"]["user_id"] = $user["user_id"];
					$response["user"]["name"] = $user["name"];
					$response["user"]["email"] = $user["email"];
					$response["user"]["alamat"] = $user["alamat"];
					$response["user"]["telephone"] = $user["telephone"];
					$response["user"]["image"] = $user["image"];
					$response["user"]["keahlian"] = $user["keahlian"];
					$response["user"]["role_id"] = $user["role_id"];
					echo json_encode($response, JSON_PRETTY_PRINT);
				} else {
					// user tidak ditemukan password/email salah
					$response["error"] = TRUE;
					$response["error_msg"] = "Login gagal, password salah";
					echo json_encode($response, JSON_PRETTY_PRINT);
				}
			} else {
				$response["error"] = TRUE;
				$response["error_msg"] = "Login gagal, email salah";
				echo json_encode($response, JSON_PRETTY_PRINT);
			}
		} else {
			$response["error"] = TRUE;
			$response["error_msg"] = "Data tidak boleh kosong";
			echo json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	public function register()
	{
		// json response array
		$response = array("error" => FALSE);
		$insertArray = array();

		// menerima parameter POST ( name, email, password dan repassword )
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		$user = $this->db->get_where('user', ['email' => $email])->num_rows();
		if ($user == 0) {
			if ($password == $password2) {
				$response["error"] = FALSE;
				$response["error_msg"] = "Register berhasil";
				$response["user"]["name"] = $name;
				$response["user"]["email"] = $email;
				$response["user"]["image"] = "user.jpg";
				$response["user"]["password"] = password_hash($password, PASSWORD_DEFAULT);
				$response["user"]["role_id"] = 3;
				echo json_encode($response, JSON_PRETTY_PRINT);

				array_push($insertArray, $response['user']);
				$this->db->insert_batch('user', $insertArray);
			} else {
				$response["error"] = TRUE;
				$response["error_msg"] = "Register gagal, password salah";
				echo json_encode($response, JSON_PRETTY_PRINT);
			}
		} else {
			$response["error"] = TRUE;
			$response["error_msg"] = "User telah ada dengan email " . $email;
			echo json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	public function change_password()
	{
		// json response array
		$response = array("error" => FALSE);

		// menerima parameter GET ( email )
		$email = $_GET['email'];

		// menerima parameter POST ( current pass, new pass dan new repass )
		$current_password = $_POST['current_password'];
		$new_password1 = $_POST['new_password1'];
		$new_password2 = $_POST['new_password2'];

		$user = $this->db->get_where('user', ['email' => $email])->result();

		if ($user) {
			if (password_verify($current_password, $user['password'])) {
				if ($new_password1 == $new_password2) {
					$response["error"] = FALSE;
					$response["error_msg"] = "Password berhasil di update";
					$response["user"]["password"] = password_hash($new_password1, PASSWORD_DEFAULT);
					echo json_encode($response, JSON_PRETTY_PRINT);

					$pass = $response["user"]["password"];
					$this->db->where('email', $email);
					$this->db->update('user', ['password' => $pass]);
				} else {
					$response["error"] = TRUE;
					$response["error_msg"] = "Tolong input password kembali";
					echo json_encode($response, JSON_PRETTY_PRINT);
				}
			} else {
				$response["error"] = TRUE;
				$response["error_msg"] = "Proses gagal, password salah";
				echo json_encode($response, JSON_PRETTY_PRINT);
			}
		}
	}
}
