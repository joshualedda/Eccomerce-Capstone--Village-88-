<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Carts';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu');
		$this->load->view('cart/index');
		$this->load->view('partials/footer');
	}

	public function addToCart()
	{
		
	}


}
