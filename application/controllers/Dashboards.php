<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->prepareUserData();
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $this->data);
		$this->load->view('partials/sidebar');
		$this->load->view('admin/dashboard');
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
