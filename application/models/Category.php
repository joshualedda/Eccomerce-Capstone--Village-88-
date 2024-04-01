<?php

class Category extends CI_Model
{
	public $users = "users";

	public function __construct()
	{
		$this->load->database();
	}

	public function getCategories()
	{
		$sql = 'SELECT * FROM categories';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
