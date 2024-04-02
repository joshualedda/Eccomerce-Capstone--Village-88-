<?php

class Cart extends CI_Model
{
	public $users = "users";

	public function __construct()
	{
		$this->load->database();
	}

	public function getCategories()
	{
		$sql = 'SELECT * FROM carts';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
