<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Products';

		if ($this->input->is_ajax_request()) {
			$name = $this->input->post('name');
			$category = $this->input->post('category');
			$data['products'] = $this->Product->filterProducts($name, $category);
			$this->load->view('components/productsTable', $data);
		} else {
			$data['products'] = $this->Product->getProducts();
			$data['categories'] = $this->Category->getCategories();
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('admin/products/index', $data);
			$this->load->view('partials/footer');
		}
	}

	public function create()
	{
		$data['categories'] = $this->Category->getCategories();
		$this->load->view('partials/header');
		$this->load->view('partials/toast');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('admin/products/create', $data);
		$this->load->view('partials/footer');
	}

	public function store()
	{
		$result = $this->Product->addProduct();

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Product Added Succesfully');
			redirect('products/create');
		} else {
			$data['error_message'] = $result['error'];
			$this->create();
		}
	}

	public function view($productId)
	{
		$data['product'] = $this->Product->getProduct($productId);
		$data['images'] = $this->Product->getProductImages($productId);
		$data['categories'] = $this->Category->getCategories();

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('admin/products/view', $data);
		$this->load->view('partials/footer');
	}

	public function edit($productId)
	{
		$data['product'] = $this->Product->getProduct($productId);
		$data['images'] = $this->Product->getProductImages($productId);
		$data['categories'] = $this->Category->getCategories();

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('admin/products/edit', $data);
		$this->load->view('partials/footer');
	}


	public function update($productId)
	{

		if ($this->Product->checkImageLimit($productId)) {
			$this->session->set_flashdata('error_message', 'Maximum 5 images allowed.');
			redirect('products/edit/' . $productId);
		}

		$result = $this->Product->updateProduct($productId);

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Product Updated Succesfully');
			redirect('products/edit/' . $productId);
		} else {
			$data['error_message'] = $result['error'];
			$this->edit($productId);
		}
	}

	public function deleteImage($imageId)
	{
		$result = $this->Product->deleteProductImage($imageId);
	
		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Product Image Deleted Successfully');
	
		} else {
			$data['error_message'] = $result['error'];
	
		}
	}
	
}
