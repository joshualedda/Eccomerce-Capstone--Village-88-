<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function index()
	{
		$data['carts'] = $this->Cart->getCarts();
		$this->prepareUserData();
		$data['totalCartAmount'] = $this->Cart->getTotalCartAmount();
		$data['title'] = 'Carts';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu', $this->data);
		$this->load->view('partials/modal');
		$this->load->view('partials/alert');
		$this->load->view('cart/index', $data);
		$this->load->view('partials/footer');
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

	//update carts
	public function updateQuantity()
	{
		$result = $this->Cart->updateCartQuantity();
		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Added Succefully'));
			} else {
				$this->session->set_flashdata('success_message', 'Added Successfully');
				redirect('carts');
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				$this->index();
			}
		}
	}

	public function removeCartItem()
	{

		$result = $this->Cart->removeCart();

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Removed Successfully'));
			} else {
				$this->session->set_flashdata('success_message', 'Removed Successfully');
				redirect('carts');
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				$this->index();
			}
		}
	}

	public function updateTotalPrice() {
		$cartId = $this->input->post('cartId');
		$newQuantity = $this->input->post('newQuantity');
		$newTotalPrice = $newQuantity * $this->Cart->getProductPrice($cartId);
	
		echo '$' . number_format($newTotalPrice, 2); 
	}
	
}
