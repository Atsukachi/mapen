<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Templates extends CI_Controller
{
  public function index()
  {
    $this->load->view('header');
    $this->load->view('topbar');
    $this->load->view('sidebar');
    $this->load->view('footer');
  }
}
