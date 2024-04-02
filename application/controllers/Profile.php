<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Profile';

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('profile/index');
		$this->load->view('partials/footer');
	}


	public function userProfile()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/menu');
		$this->load->view('profile/index');
		$this->load->view('partials/footer');
	}


}
