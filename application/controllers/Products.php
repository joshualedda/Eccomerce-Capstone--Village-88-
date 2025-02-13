<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Products';
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

		$recordsPerPage = 10;
		$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
		$offset = ($currentPage - 1) * $recordsPerPage;

		if ($this->input->is_ajax_request()) {
			$name = $this->input->post('name');
			$category = $this->input->post('category');
			$data['products'] = $this->Product->filterProducts($name, $category, $recordsPerPage, $offset);
			$this->load->view('components/productsTable', $data);
		} else {

			$data['products'] = $this->Product->getProductsPaginated($recordsPerPage, $offset);
			$totalCategories = $this->Product->countProducts();
			$totalPages = ceil($totalCategories / $recordsPerPage);
			$data['pagination'] = [
				'currentPage' => $currentPage,
				'totalPages' => $totalPages
			];

			$data['categories'] = $this->Category->getCategories();
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar', $this->data);
			$this->load->view('partials/sidebar');
			$this->load->view('admin/products/index', $data);
			$this->load->view('partials/footer');
		}
	}

	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');
		$user_role = $this->session->userdata('role');
		$cartsTotal = $this->Cart->countCarts();


		$this->data['user_data'] = $user_data;
		$this->data['is_logged_in'] = $is_logged_in;
		$this->data['role'] = $user_role;
		$this->data['cartsTotal'] = $cartsTotal;
	}
	private function redirectIfUnauthorized()
	{
		if (!$this->data['is_logged_in'] || $this->data['role'] != 1) {
			$previous_url = $_SERVER['HTTP_REFERER'];
			redirect($previous_url);
		}
	}


	public function create()
	{
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

		$data['categories'] = $this->Category->getCategories();
		$this->load->view('partials/header');
		$this->load->view('partials/toast');
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/sidebar');
		$this->load->view('partials/alert');
		$this->load->view('admin/products/create', $data);
		$this->load->view('partials/footer');
	}

	public function store()
	{
		$result = $this->Product->addProduct();

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Product Created Succesfully'));
			} else {
				$this->session->set_flashdata('success_message', 'Product Created Succesfully');
				redirect('products/create');
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				$this->create();
			}
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
		$this->load->view('partials/toast');
		$this->load->view('admin/products/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update($productId)
	{
	
		$result = $this->Product->updateProduct($productId);
	
		if (isset($result['success']) && $result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Product Updated Successfully'));
			} else {
				$this->session->set_flashdata('success_message', 'Product Updated Successfully');
				redirect('products/edit/' . $productId);
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => isset($result['error']) ? $result['error'] : 'Unknown error occurred'));
			} else {
				$data['error_message'] = isset($result['error']) ? $result['error'] : 'Unknown error occurred';
				$this->edit($productId);
			}
		}
	}
	

	public function deleteImage($imageId)
	{
		$result = $this->Product->deleteProductImage($imageId);

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Deleted Successfully'));
			} else {
				$this->session->set_flashdata('success_message', 'Deleted Successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				redirect($_SERVER['HTTP_REFERER']);

			}
		}
	}
	//update main images
	public function updateMainImage($imageId)
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$mainStatus = $this->input->post('main_status');

		$result = $this->Product->updateMainImage($imageId, $mainStatus);

		if ($result) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode(['success' => false, 'error' => 'Failed to update main image status']);
		}
	}



}
