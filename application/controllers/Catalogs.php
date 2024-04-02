<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catalogs extends CI_Controller
{
	public function index()
	{
		$data['products'] = $this->Product->getProductsWithMainImages();
		$this->prepareUserData();
		$this->load->view('partials/header', $this->data);
		$this->load->view('partials/menu', $this->data);
		$this->load->view('partials/alert', $this->data);
		$this->load->view('partials/toast');
		$this->load->view('catalog/index', $data);
		$this->load->view('partials/footer');
	}




	public function addToCart()
	{
		$user_id = $this->session->userdata('id');
		if (!$user_id) {
			$this->session->set_flashdata('error_message', 'You need to login first.');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}

		$result = $this->Catalog->createCart();

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Added To Cart');
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$this->session->set_flashdata('error_message', $result['error']);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function view($productId)
	{
		$data['product'] = $this->Product->getProduct($productId);
		$data['image'] = $this->Product->getProductMainImage($productId);
	
		if ($data['product']) {
			$data['title'] = $data['product']['name'];
		} else {
			$data['title'] = 'Product Not Found';
		}
	
		$this->prepareUserData();
	
		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu', $this->data); // Pass $this->data to the menu view
		$this->load->view('partials/alert');
		$this->load->view('catalog/view', $data);
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
