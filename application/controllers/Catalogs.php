<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catalogs extends CI_Controller
{
	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/menu');
		$this->load->view('catalog/index');
		$this->load->view('partials/footer');
	}


	public function view()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/menu');
		$this->load->view('catalog/view');
		$this->load->view('partials/footer');
	}


}
