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

		$sql = "INSERT INTO carts(user_id, product_id, quantity) VALUES
		(?, ?, ?)";
		$query = $this->db->query($sql, array( $user_id, $product_id, $quantity));

		if ($query) {
			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error.');
		}
	}
}
