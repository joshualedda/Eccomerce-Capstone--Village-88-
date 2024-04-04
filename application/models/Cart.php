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
					products.price AS productPrice, 
					SUM(products.price * carts.quantity) AS totalPrice, 
					images.image AS mainImage
				FROM carts
				LEFT JOIN products ON carts.product_id = products.id
				LEFT JOIN images ON products.id = images.product_id AND images.main = 1
				WHERE carts.user_id = ?
				GROUP BY carts.product_id";

		$query = $this->db->query($sql, array($userId));
		return $query->result_array();
	}

	// Total Amount
	public function getTotalCartAmount()
	{
    $userId = $this->session->userdata('id');
    $sql = "SELECT 
                SUM(products.price * carts.quantity) AS totalCartAmount
            FROM carts
            LEFT JOIN products ON carts.product_id = products.id
            WHERE carts.user_id = ?";

    $query = $this->db->query($sql, array($userId));
    $row = $query->row_array();

    return $row['totalCartAmount'];
	}



	public function countCarts()
	{
		$userId = $this->session->userdata('id');
		$sql = "SELECT COUNT(*) AS cartCount
            FROM carts
            WHERE user_id = ?";

		$query = $this->db->query($sql, array($userId));

		return ($query) ? $query->row()->cartCount : 0;
	}

	public function updateCartQuantity($cartId, $quantity)
	{
		$sql = "UPDATE carts SET quantity = ? WHERE id = ?";
		$this->db->query($sql, array($quantity, $cartId));
	}




}
