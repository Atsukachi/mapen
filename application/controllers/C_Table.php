<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Table extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Data', 'data');
	}

	public function skpbyid()
	{
		$user_id = $this->input->get('user_id');
		echo json_encode($this->data->getSKPbyID($user_id));
	}

	public function unit_kerja()
	{
		echo json_encode($this->data->getUnitKerja());
	}
}
