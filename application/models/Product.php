<?php

class Product extends CI_Model
{
	public $users = "users";

	public function __construct()
	{
		$this->load->database();
	}

	public function getProducts()
	{
		$sql = "SELECT products.id AS productId, products.*, categories.*
				FROM products
				LEFT JOIN categories ON categories.id = products.category_id
				ORDER BY products.created_at DESC";

		$query = $this->db->query($sql);
		return $query->result_array();
	}


	//get single product
	public function getProduct($productId)
	{
		$sql = "SELECT * FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($productId));
		return $query->row_array();
	}
	public function getProductImages($productId)
	{
		$sql = "SELECT * FROM images WHERE product_id = ?";
		$query = $this->db->query($sql, array($productId));
		return $query->result_array();
	}

	//insert product
	public function addProduct()
	{
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('stocks', 'Stocks', 'required|numeric');

		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}

		$product = $this->security->xss_clean($this->input->post('product'));
		$description = $this->security->xss_clean($this->input->post('description'));
		$category = $this->security->xss_clean($this->input->post('category'));
		$price = $this->security->xss_clean($this->input->post('price'));
		$stocks = $this->security->xss_clean($this->input->post('stocks'));

		$sql = "INSERT INTO products (category_id, name, description, price, stocks) VALUES (?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($category, $product, $description, $price, $stocks));

		if ($query) {
			$product_id = $this->db->insert_id();

			$uploaded_images = $this->uploadImages();
			$main_images = $this->input->post('main_image');
			foreach ($uploaded_images as $key => $image) {
				$main_flag = isset($main_images[$key]) ? 1 : 0;
				$this->db->insert('images', array('product_id' => $product_id, 'image' => $image, 'main' => $main_flag));
			}

			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error.');
		}
	}

	//insert multiple images from the uploads
	public function uploadImages()
	{
		$uploaded_images = array();
		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048; // 2MB limit 
		$this->load->library('upload', $config);

		if (count($_FILES['images']['name']) > 5) {
			$this->session->set_flashdata('error_message', 'Maximum 5 images allowed.');
		}

		foreach ($_FILES['images']['name'] as $key => $image) {
			$_FILES['userfile']['name'] = $_FILES['images']['name'][$key];
			$_FILES['userfile']['type'] = $_FILES['images']['type'][$key];
			$_FILES['userfile']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
			$_FILES['userfile']['error'] = $_FILES['images']['error'][$key];
			$_FILES['userfile']['size'] = $_FILES['images']['size'][$key];

			if ($this->upload->do_upload('userfile')) {
				$data = $this->upload->data();
				$uploaded_images[] = $data['file_name']; 
			} else {
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect('products/create');
			}
		}

		return $uploaded_images;
	}


	//update product
	public function updateProduct($productId)
	{
		// Validate form data
		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('stocks', 'Stocks', 'required|numeric');

		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}
		$product = $this->security->xss_clean($this->input->post('product'));
		$description = $this->security->xss_clean($this->input->post('description'));
		$category = $this->security->xss_clean($this->input->post('category'));
		$price = $this->security->xss_clean($this->input->post('price'));
		$stocks = $this->security->xss_clean($this->input->post('stocks'));

		$sql = "UPDATE products SET category_id = ?, name = ?, description = ?, price = ?, stocks = ? 
		WHERE id = ?";

		$query = $this->db->query($sql, array($category, $product, $description, $price, $stocks, $productId));

		if ($query) {
			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error.');
		}
	}
}
