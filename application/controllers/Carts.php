<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/menu');
		$this->load->view('cart/index');
		$this->load->view('partials/footer');
	}



}
