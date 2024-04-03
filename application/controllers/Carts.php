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
		$cartId = $this->input->post('cart_id');
		$quantity = $this->input->post('quantity');


$this->Cart->updateCartQuantity($cartId, $quantity);

		echo json_encode(['success' => true]);
	}

		public function removeCartItem()
		{
			$cartId = $this->input->post('cart_id');

			$this->db->where('id', $cartId);
			$this->db->delete('carts');

			// Check if the delete operation was successful
			if ($this->db->affected_rows() > 0) {
				echo json_encode(['success' => true]);
			} else {
				echo json_encode(['success' => false, 'error' => 'Error removing item from cart']);
			}
		}

}
