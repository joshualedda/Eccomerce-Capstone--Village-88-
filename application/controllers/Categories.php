<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{

	public function index()   
	{
		$this->prepareUserData();
		$this->redirectIfUnauthorized();
	
		$recordsPerPage = 5;
	
		$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
	
		$offset = ($currentPage - 1) * $recordsPerPage;
	
		if ($this->input->is_ajax_request()) {
			$name = $this->input->post('name');
			$data['categories'] = $this->Category->filterCategories($name);
			$this->load->view('components/categoriesTable', $data);
		} else {
				$data['categories'] = $this->Category->getCategoriesPaginated($recordsPerPage, $offset);
		
				$totalCategories = $this->Category->countCategories();
	
			$totalPages = ceil($totalCategories / $recordsPerPage);
	
			$data['pagination'] = [
				'currentPage' => $currentPage,
				'totalPages' => $totalPages
			];
	
			// Load the view with pagination
			$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('admin/categories/index', $data);
			$this->load->view('partials/footer');
		}
	}
	

	private function redirectIfUnauthorized()
	{
		if (!$this->data['is_logged_in'] || $this->data['role'] != 1) {
			$previous_url = $_SERVER['HTTP_REFERER'];
			redirect($previous_url);
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
	public function create()
	{
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('partials/alert');
		$this->load->view('partials/toast');
		$this->load->view('admin/categories/create');
		$this->load->view('partials/footer');
	}

	public function store()
	{
		$result = $this->Category->createCategory();

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Category Created Succesfully'));
			} else {
				$this->session->set_flashdata('success_message', 'Category Created Succesfully');
				redirect('category/create');
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

	public function view($categoryId)
	{
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

		$data['category'] = $this->Category->getCategory($categoryId);
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('partials/alert');
		$this->load->view('admin/categories/view', $data);
		$this->load->view('partials/footer');
	}
	public function edit($categoryId)
	{
		$data['category'] = $this->Category->getCategory($categoryId);
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('partials/sidebar');
		$this->load->view('partials/alert');
		$this->load->view('partials/toast');
		$this->load->view('admin/categories/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update($categoryId)
	{
		$result = $this->Category->updateCategory($categoryId);

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Category Updated Succesfully'));
			} else {
				$this->session->set_flashdata('success_message', 'Category Updated Succesfully');
				redirect('category/edit/' . $categoryId);
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				$this->session->set_flashdata('error_message', $result['error']);
			}
		}
	}
}
