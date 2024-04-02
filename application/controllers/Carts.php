<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function index()
	{
		$data['carts'] = $this->Cart->getCarts();
		$this->prepareUserData();

		$data['title'] = 'Carts';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu', $this->data);
		$this->load->view('cart/index', $data);
		$this->load->view('partials/footer');
	}

	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');
	
		$this->data['user_data'] = $user_data;
		$this->data['is_logged_in'] = $is_logged_in;
	}

}
