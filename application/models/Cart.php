<?php

class Cart extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getCarts()
	{
		$userId = $this->session->userdata('id');
		$sql = "SELECT carts.id AS cartId, carts.quantity, products.id AS productId, 
				products.name AS productName, products.price AS price,
				images.image AS mainImage
				FROM carts
				LEFT JOIN products ON carts.product_id = products.id
				LEFT JOIN images ON products.id = images.product_id AND images.main = 1
				WHERE carts.user_id = ?";
	
		$query = $this->db->query($sql, array($userId));
		return $query->result_array();
	}
	
	
	
	
}
