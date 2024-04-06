<?php

class Category extends CI_Model
{

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


	public function getCategory($categoryId)
	{
		$sql = 'SELECT * FROM categories WHERE id = ?';
		$query = $this->db->query($sql, array($categoryId));
		return $query->row_array();
	}

	public function getCategoriesPaginated($limit, $offset)
	{
		$sql = "SELECT * FROM categories LIMIT ?, ?";
		$query = $this->db->query($sql, array($offset, $limit));
		return $query->result_array();
	}

	public function countCategories()
	{
		$sql = "SELECT COUNT(*) AS total_categories FROM categories";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result['total_categories'];
	}

	public function createCategory()
	{
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('description', 'Category Description', 'required');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$category = $this->security->xss_clean($this->input->post('category'));
			$description = $this->security->xss_clean($this->input->post('description'));

			$sql = "SELECT * FROM categories WHERE category = ?";
			$query = $this->db->query($sql, array($category));

			if ($query->num_rows() > 0) {
				return array('success' => false, 'error' => 'Category already exists.');
			}

			$sql = "INSERT INTO categories (category, description) VALUES (?, ?)";
			$query_result = $this->db->query($sql, array($category, $description));

			if ($query_result) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error inserting category.');
			}
		}
	}

	// Update Category
	public function updateCategory($categoryId)
	{
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}

		$category = $this->security->xss_clean($this->input->post('category'));
		$description = $this->security->xss_clean($this->input->post('description'));

		$sql = "SELECT * FROM categories WHERE category = ? AND id != ?";
		$query = $this->db->query($sql, array($category, $categoryId));

		if ($query->num_rows() > 0) {
			return array('success' => false, 'error' => 'Category already exists.');
		}

		$sql = "UPDATE categories SET category = ?, description = ? WHERE id = ?";
		$query = $this->db->query($sql, array($category, $description, $categoryId));

		if ($query) {
			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error updating category.');
		}
	}

	//Search Category
	public function filterCategories($name, $recordsPerPage, $offset)
	{
		$sql = "SELECT * FROM categories WHERE 1";

		$params = [];

		if (!empty($name)) {
			$sql .= " AND (categories.category LIKE ?)";
			$nameLike = "%$name%";
			$params[] = $nameLike;
		}

		$sql .= " LIMIT ?, ?";
		$params[] = $offset;
		$params[] = $recordsPerPage;

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}
}
