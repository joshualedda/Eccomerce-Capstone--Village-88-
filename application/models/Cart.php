<?php

class Cart extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	//get cart with the main image
	public function getCarts()
	{
		$userId = $this->session->userdata('id');
		$sql = "SELECT 
					carts.id AS cartId,
					carts.product_id AS productId, 
					SUM(carts.quantity) AS totalQuantity, 
					products.name AS productName, 
					products.price AS price,
					images.image AS mainImage
				FROM carts
				LEFT JOIN products ON carts.product_id = products.id
				LEFT JOIN images ON products.id = images.product_id AND images.main = 1
				WHERE carts.user_id = ?
				GROUP BY carts.product_id";
	
		$query = $this->db->query($sql, array($userId));
		return $query->result_array();
	}
	
	public function updateCartQuantity($cartId, $quantity)
	{
		$sql = "UPDATE carts SET quantity = ? WHERE id = ?";
		$this->db->query($sql, array($quantity, $cartId));
	}
	
	
	
	
}
