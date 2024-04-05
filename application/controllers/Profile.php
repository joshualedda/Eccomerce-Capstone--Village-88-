<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Profile';
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

		$data['carts'] = $this->Cart->getCarts();

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $this->data);
		$this->load->view('partials/sidebar');
		$this->load->view('partials/alert');
		$this->load->view('partials/toast');
		$this->load->view('admin/profile/index', $data);
		$this->load->view('partials/footer');
	}


	private function redirectIfUnauthorized()
	{
		if (!$this->data['is_logged_in'] || $this->data['role'] != 1) {
			$previous_url = $_SERVER['HTTP_REFERER'];
			redirect($previous_url);
		}
	}
	
	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');
		$user_role = $this->session->userdata('role');
		$cartsTotal = $this->Cart->countCarts();


		$this->data['user_data'] = $user_data;
		$this->data['is_logged_in'] = $is_logged_in;
		$this->data['role'] = $user_role;
		$this->data['cartsTotal'] = $cartsTotal;
	}
	public function userProfile()
	{
		$data = $this->prepareUserData();
		$data = $this->redirectIfUnauthorized();

		$this->load->view('partials/header');
		$this->load->view('partials/alert');
		$this->load->view('partials/menu', $this->data); 
		$this->load->view('partials/toast');
		$this->load->view('profile/index', $data);
		$this->load->view('partials/footer');
	}

	public function updateProfile()
	{
		$result = $this->User->updateProfile();

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Profile Updated Succesfully');
			redirect('profile');
		} else {
			$data['error_message'] = $result['error'];
			$this->index();
		}
	}

	public function updatePassword()
	{
		$result = $this->User->updatePassword();

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Profile Updated Succesfully');
			redirect('profile');
		} else {
			$data['error_message'] = $result['error'];
			$this->index();
		}
	}
}
