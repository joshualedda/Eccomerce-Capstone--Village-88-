<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

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
		$user_role = $this->session->userdata('role');

		$this->data['user_data'] = $user_data;
		$this->data['is_logged_in'] = $is_logged_in;
		$this->data['role'] = $user_role;
	}

	private function redirectIfUnauthorized()
	{
		if (!$this->data['is_logged_in'] || $this->data['role'] != 1) {
			$previous_url = $_SERVER['HTTP_REFERER'];
			redirect($previous_url);
		}
	}
}
