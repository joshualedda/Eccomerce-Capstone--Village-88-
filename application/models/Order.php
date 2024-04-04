<?php

class Order extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function validateOrderForm()
	{
		$this->form_validation->set_rules('firstNameShipping', 'First Name (Shipping)', 'required');
		$this->form_validation->set_rules('lastNameShipping', 'Last Name (Shipping)', 'required');
		$this->form_validation->set_rules('address1Shipping', 'Address 1 (Shipping)', 'required');
		$this->form_validation->set_rules('cityShipping', 'City (Shipping)', 'required');
		$this->form_validation->set_rules('stateShipping', 'State (Shipping)', 'required');
		$this->form_validation->set_rules('zipShipping', 'ZIP Code (Shipping)', 'required');

		$checkbox = $this->input->post('checkbox');

		if (!empty($checkbox)) {
			$this->form_validation->set_rules('firstNameBilling', 'First Name (Billing)', '');
			$this->form_validation->set_rules('lastNameBilling', 'Last Name (Billing)', '');
			$this->form_validation->set_rules('address1Billing', 'Address 1 (Billing)', '');
			$this->form_validation->set_rules('cityBilling', 'City (Billing)', '');
			$this->form_validation->set_rules('stateBilling', 'State (Billing)', '');
			$this->form_validation->set_rules('zipBilling', 'ZIP Code (Billing)', '');
		} else {
			$this->form_validation->set_rules('firstNameBilling', 'First Name (Billing)', 'required');
			$this->form_validation->set_rules('lastNameBilling', 'Last Name (Billing)', 'required');
			$this->form_validation->set_rules('address1Billing', 'Address 1 (Billing)', 'required');
			$this->form_validation->set_rules('cityBilling', 'City (Billing)', 'required');
			$this->form_validation->set_rules('stateBilling', 'State (Billing)', 'required');
			$this->form_validation->set_rules('zipBilling', 'ZIP Code (Billing)', 'required');
		}

	}

	public function addOrder()
	{
		$this->validateOrderForm();
		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}

		$checkbox = $this->security->xss_clean($this->input->post('checkbox'));

		$firstNameShipping = $this->security->xss_clean($this->input->post('firstNameShipping'));
		$lastNameShipping = $this->security->xss_clean($this->input->post('lastNameShipping'));
		$address1Shipping = $this->security->xss_clean($this->input->post('address1Shipping'));
		$address2Shipping = $this->security->xss_clean($this->input->post('address2Shipping'));
		$cityShipping = $this->security->xss_clean($this->input->post('cityShipping'));
		$stateShipping = $this->security->xss_clean($this->input->post('stateShipping'));
		$zipShipping = $this->security->xss_clean($this->input->post('zipShipping'));

		$firstNameBilling = $this->security->xss_clean($this->input->post('firstNameBilling'));
		$lastNameBilling = $this->security->xss_clean($this->input->post('lastNameBilling'));
		$address1Billing = $this->security->xss_clean($this->input->post('address1Billing'));
		$address2Billing = $this->security->xss_clean($this->input->post('address2Billing'));
		$cityBilling = $this->security->xss_clean($this->input->post('cityBilling'));
		$stateBilling = $this->security->xss_clean($this->input->post('stateBilling'));
		$zipBilling = $this->security->xss_clean($this->input->post('zipBilling'));



		$userId = $this->session->userdata('id');

		$sql = "SELECT carts.*, products.price 
				FROM carts 
				JOIN products ON carts.product_id = products.id 
				WHERE carts.user_id = ?";
		$query = $this->db->query($sql, array($userId));
		$cartItems = $query->result_array();
		
		if (empty($cartItems)) {
			return array('success' => false, 'error' => 'Cart is empty.');
		}
	

		if (!empty($checkbox)) {
			$firstNameBilling = $firstNameShipping;
			$lastNameBilling = $lastNameShipping;
			$address1Billing = $address1Shipping;
			$address2Billing = $address2Shipping;
			$cityBilling = $cityShipping;
			$stateBilling = $stateShipping;
			$zipBilling = $zipShipping;
		}

		$insertSuccess = true;

		foreach ($cartItems as $item) {
			$productId = $item['product_id'];
			$quantity = $item['quantity'];
			$totalAmount = $item['price'] * $quantity; 
		
			$sqlShipping = "INSERT INTO shippings (first_name, last_name, main_address, secondary_address, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$queryShipping = $this->db->query($sqlShipping, array($firstNameShipping, $lastNameShipping, $address1Shipping, $address2Shipping, $cityShipping, $stateShipping, $zipShipping));
		
			if (!$queryShipping) {
				$insertSuccess = false;
				break;
			}
		
			$shipping_id = $this->db->insert_id(); 
		
			// Insert billing 
			$sqlBilling = "INSERT INTO billings (first_name, last_name, main_address, secondary_address, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$queryBilling = $this->db->query($sqlBilling, array($firstNameBilling, $lastNameBilling, $address1Billing, $address2Billing, $cityBilling, $stateBilling, $zipBilling));
		
			if (!$queryBilling) {
				$insertSuccess = false;
				break; 
			}
		
			$billing_id = $this->db->insert_id(); 

			// Insert order
			$sqlOrder = "INSERT INTO orders (user_id, product_id, shipping_id, billing_id, 	total_amount) VALUES (?, ?, ?, ?, ?)";
			$queryOrder = $this->db->query($sqlOrder, array($userId, $productId, $shipping_id, $billing_id, $totalAmount));
		
			if (!$queryOrder) {
				$insertSuccess = false;
				break; 
			}
		}
		
		if ($insertSuccess) {
			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error inserting shipping information, billing information, or order.');
		}
	}
}
