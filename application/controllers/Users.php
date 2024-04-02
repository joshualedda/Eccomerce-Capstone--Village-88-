<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('catalogs');
		}

		$this->load->view('partials/header');
		$this->load->view('partials/alert');
		$this->load->view('auth/login');
		$this->load->view('partials/footer');
	}


	public function register()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('catalogs');
		}
		$this->load->view('partials/header');
		$this->load->view('auth/register');
		$this->load->view('partials/footer');
	}

	///login process here
	public function login()
	{
		$result = $this->User->loginUser();

		if ($result['success']) {

			$user = $result['user'];

			$user_data = array(
				'id' => $user['id'],
				'email' => $user['email'],
				'logged_in' => true
			);

			$this->session->set_userdata($user_data);

			if ($user['role'] == 0) {
				redirect('catalogs');
			} elseif ($user['role'] == 1) {
				redirect('dashboard');
			}
		} else {
			$data['error_message'] = $result['error'];
			$data['error_message'] = 'Invalid Credentials.';

			$this->load->view('partials/header');
			$this->load->view('partials/alert');
			$this->load->view('auth/login', $data);
			$this->load->view('partials/footer');
		}
	}

	public function registerProcess()
	{
		$result = $this->User->registerUser();

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Registered Succesfully.');
		} else {
			$data['error_message'] = $result['error'];
			$this->session->set_flashdata('error_message', $result['error']);
		}
		$this->register();
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		redirect('catalogs');
	}
}
