<?php

class Catalog extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function createCart()
	{
		$this->form_validation->set_rules('product_id', 'Product', 'required');

		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}

		$product_id = $this->security->xss_clean($this->input->post('product_id'));
		$user_id = $this->session->userdata('id');
		$quantity = $this->security->xss_clean($this->input->post('quantity'));

		$existing_cart_item = $this->db->get_where('carts', array('user_id' => $user_id, 'product_id' => $product_id))->row_array();

		if ($existing_cart_item) {
			$new_quantity = $existing_cart_item['quantity'] + $quantity;

			$sql = "UPDATE carts SET quantity = ? WHERE id = ?";
			$this->db->query($sql, array($new_quantity, $existing_cart_item['id']));

			return array('success' => true);
		} else {
			$data = array(
				'user_id' => $user_id,
				'product_id' => $product_id,
				'quantity' => $quantity
			);

			$sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)";
			$this->db->query($sql, array($user_id, $product_id, $quantity));

			return array('success' => true);
		}
	}
}
