<?php

class Product extends CI_Model
{
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
	public function getProductsPaginated($limit, $offset)
	{
		$sql = "SELECT products.id AS productId, products.*, categories.*
            FROM products
            LEFT JOIN categories ON categories.id = products.category_id
            ORDER BY products.created_at DESC
            LIMIT ?, ?";

		$query = $this->db->query($sql, array($offset, $limit));
		return $query->result_array();
	}

	//count procut

	public function countProducts()
	{
		$sql = "SELECT COUNT(*) AS total_products FROM products";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result['total_products'];
	}
	public function getProductsWithMainImages($recordsPerPage, $offset)
	{
		$sql = "SELECT products.id AS productId, 
					   products.name, 
					   products.description, 
					   products.price, 
					   products.stocks, 
					   categories.category AS categoryName,
					   COALESCE(images.image, '') AS main_image_url
				FROM products
				LEFT JOIN categories ON categories.id = products.category_id
				LEFT JOIN images ON images.product_id = products.id AND images.main = 1
				ORDER BY products.stocks DESC
				LIMIT ?, ?";

		$query = $this->db->query($sql, array($offset, $recordsPerPage));
		$results = $query->result_array();

		foreach ($results as &$result) {
			if (empty($result['main_image_url'])) {
				$newestImageQuery = "SELECT image
									 FROM images
									 WHERE product_id = ?
									 ORDER BY created_at DESC
									 LIMIT 1";
				$newestImageQueryResult = $this->db->query($newestImageQuery, array($result['productId']))->row_array();

				$result['main_image_url'] = !empty($newestImageQueryResult) ? $newestImageQueryResult['image'] : '';
			}
		}

		return $results;
	}





	public function getProductMainImage($productId)
	{
		$mainImageQuery = "SELECT images.image AS main_image_url
                       FROM images
                       WHERE images.product_id = ? AND images.main = 1";
		$mainImage = $this->db->query($mainImageQuery, array($productId))->row_array();

		if ($mainImage) {
			return $mainImage;
		} else {
			$newestImageQuery = "SELECT images.image AS main_image_url
                             FROM images
                             WHERE images.product_id = ?
                             ORDER BY images.created_at DESC
                             LIMIT 1";
			$newestImage = $this->db->query($newestImageQuery, array($productId))->row_array();

			return $newestImage ? $newestImage : array();
		}
	}



	//search functions
	public function filterProducts($name, $categoryId)
	{
		$sql = "SELECT products.id AS productId, products.*, categories.*
				FROM products
				LEFT JOIN categories ON categories.id = products.category_id
				WHERE 1";

		$params = [];

		if (!empty($name)) {
			$sql .= " AND (products.name LIKE ? OR products.price LIKE ? OR categories.category LIKE ?)";
			$nameLike = "%$name%";
			$params = array($nameLike, $nameLike, $nameLike);
		}

		if (!empty($categoryId)) {
			$sql .= " AND products.category_id = ?";
			$params[] = $categoryId;
		}

		$sql .= " ORDER BY products.created_at DESC";

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}


	//get single product
	public function getProduct($productId)
	{
		$sql = "SELECT * FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($productId));
		return $query->row_array();
	}

	//Similar items in View
	public function getSimilarItems($categoryId)
	{
		$sql = "SELECT products.id AS productId, products.name, products.description, products.price, products.stocks, 
		COALESCE(images.image, (SELECT image FROM images WHERE product_id = products.id LIMIT 1)) AS main_image_url
		FROM products
		LEFT JOIN images ON images.product_id = products.id AND images.main = 1
		WHERE products.category_id = ?
		ORDER BY products.stocks DESC";

		$query = $this->db->query($sql, array($categoryId));
		return $query->result_array();
	}


	//Get product Image
	public function getProductImages($productId)
	{
		$sql = "SELECT * FROM images WHERE product_id = ?;
		";
		$query = $this->db->query($sql, array($productId));
		return $query->result_array();
	}

	public function getProductImagesView($productId)
	{
		$sql = "SELECT * FROM images WHERE product_id = ?
		AND main = 0;
		";
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


		$uploaded_images = $this->uploadImages();
		if (empty($uploaded_images)) {
			return array('success' => false, 'error' => 'Please upload at least one image.');
		}

		$sql = "SELECT * FROM products WHERE name = ? LIMIT 1";
		$existing_product = $this->db->query($sql, array($product))->row();

		if ($existing_product) {
			return array('success' => false, 'error' => 'Product with the same name already exists.');
		}

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


	public function checkImageLimit($productId)
	{
		$sql = "SELECT COUNT(*) as total_images FROM images WHERE product_id = ?";
		$query = $this->db->query($sql, array($productId));
		$result = $query->row_array();
		return $result['total_images'] >= 5;
	}


	//insert multiple images from the uploads
	public function uploadImages()
	{
		$uploaded_images = array();
		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 20048; // 8MB limit
		$this->load->library('upload', $config);

		foreach ($_FILES['images']['name'] as $key => $image) {
			if (count($uploaded_images) >= 5) {
				$this->session->set_flashdata('error_message', 'Only the first 5 images were processed. Maximum 5 images allowed.');
				break;
			}

			$_FILES['userfile']['name'] = $_FILES['images']['name'][$key];
			$_FILES['userfile']['type'] = $_FILES['images']['type'][$key];
			$_FILES['userfile']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
			$_FILES['userfile']['error'] = $_FILES['images']['error'][$key];
			$_FILES['userfile']['size'] = $_FILES['images']['size'][$key];

			if ($this->upload->do_upload('userfile')) {
				$data = $this->upload->data();
				$uploaded_images[] = $data['file_name'];
			} else {
				$this->session->set_flashdata('error_message', "Please reduce the image quality");
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

		// Update product information
		$sql = "UPDATE products SET category_id = ?, name = ?, description = ?, price = ?, stocks = ? WHERE id = ?";
		$query = $this->db->query($sql, array($category, $product, $description, $price, $stocks, $productId));

		if ($query) {
			// Upload and insert images only if the update is successful
			$this->uploadAndInsertImages($productId);

			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error updating product.');
		}
	}

	private function uploadAndInsertImages($productId)
	{
		if ($this->checkImageLimit($productId)) {
			$this->session->set_flashdata('error_message', 'Maximum 5 images allowed.');
			return;
		}

		$uploaded_images = $this->uploadImages();

		foreach ($uploaded_images as $key => $image) {
			if ($this->checkImageLimit($productId)) {
				$this->session->set_flashdata('error_message', 'Maximum 5 images allowed.');
				break;
			}

			$main_flag = $this->input->post('main_image')[$key] ?? 0;
			$this->db->insert('images', array('product_id' => $productId, 'image' => $image, 'main' => $main_flag));
		}
	}


	// Delete Image
	public function deleteProductImage($imageId)
	{
		$sql = "SELECT image FROM images WHERE id = ?";
		$query = $this->db->query($sql, array($imageId));
		$image = $query->row_array();

		if (!$image) {
			return ['success' => false, 'error' => 'Image not found'];
		}

		$filePath = FCPATH . 'assets/uploads/' . $image['image'];

		if (file_exists($filePath)) {
			unlink($filePath);
		}

		$sqlDelete = "DELETE FROM images WHERE id = ?";
		$this->db->query($sqlDelete, array($imageId));

		return ['success' => true];
	}


	//Search Catalog
	public function filterCatalog($name, $categoryId, $priceOrder)
	{
		$sql = "SELECT products.id AS productId, 
		products.name, 
		products.description, 
		products.price, 
		products.stocks, 
		categories.category AS categoryName,
		COALESCE(images.image, '') AS main_image_url
 FROM products
 LEFT JOIN categories ON categories.id = products.category_id
 LEFT JOIN images ON images.product_id = products.id AND images.main = 1
				WHERE 1";

		$params = [];

		if (!empty($name)) {
			$sql .= " AND (products.name LIKE ? OR products.description LIKE ?)";
			$nameLike = "%$name%";
			$params[] = $nameLike;
			$params[] = $nameLike;
		}

		if (!empty($categoryId)) {
			$sql .= " AND products.category_id = ?";
			$params[] = $categoryId;
		}

		if ($priceOrder == 'desc') {
			$sql .= " ORDER BY products.price DESC";
		} elseif ($priceOrder == 'asc') {
			$sql .= " ORDER BY products.price ASC";
		} else {
			$sql .= " ORDER BY products.created_at DESC";
		}

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function updateMainImage($imageId, $mainStatus)
	{
		$this->db->trans_start();

		$productId = $this->getProductIdForImage($imageId);
		$sql = "UPDATE images SET main = 0 WHERE product_id = ?";
		$this->db->query($sql, array($productId));

		$sql = "UPDATE images SET main = ? WHERE id = ?";
		$this->db->query($sql, array($mainStatus, $imageId));

		$success = $this->db->trans_complete();

		return $success;
	}

	public function getProductIdForImage($imageId)
	{
		$sql = "SELECT product_id FROM images WHERE id = ?";
		$query = $this->db->query($sql, array($imageId));

		if ($query && $query->num_rows() > 0) {
			$result = $query->row();
			return $result->product_id;
		} else {
			return null;
		}
	}




}
