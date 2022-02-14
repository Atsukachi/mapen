<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // is_logged_in();
    $this->load->model('M_Website', 'website');
  }

  public function index()
  {
    $data['title'] = "Mapen";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->view('templates/webs/header', $data);
    $this->load->view('index');
    $this->load->view('templates/webs/footer');
  }
}
