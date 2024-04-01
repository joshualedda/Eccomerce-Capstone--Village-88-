<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{

	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('partials/footer');
	}

}
