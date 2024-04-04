<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catalogs extends CI_Controller
{
	public function index()
	{
		if ($this->input->is_ajax_request()) {
			$name = $this->input->post('name');
			$category = $this->input->post('category');
			$priceOrder = $this->input->post('price_order');
			$data['products'] = $this->Product->filterCatalog($name, $category, $priceOrder);
			$this->load->view('components/catalogsPartial', $data);
		} else {
			$data['products'] = $this->Product->getProductsWithMainImages();
			$data['categories'] = $this->Category->getCategories();

			$this->prepareUserData();
			$this->load->view('partials/header', $this->data);
			$this->load->view('partials/menu', $this->data);
			$this->load->view('partials/alert', $this->data);
			$this->load->view('partials/toast');
			$this->load->view('catalog/index', $data);
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


	public function addToCart()
	{
		$user_id = $this->session->userdata('id');
		if (!$user_id) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => 'You need to login first.'));
			} else {
				$this->session->set_flashdata('error_message', 'You need to login first.');
				redirect($_SERVER['HTTP_REFERER']);
			}
			return;
		}

		$result = $this->Catalog->createCart();

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Added To Cart'));
			} else {
				$this->session->set_flashdata('success_message', 'Added To Cart');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$this->session->set_flashdata('error_message', $result['error']);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}



	public function view($productId)
	{
		$data['product'] = $this->Product->getProduct($productId);
		$data['image'] = $this->Product->getProductMainImage($productId);

		$categoryId = $data['product']['category_id'];
		$data['items'] = $this->Product->getSimilarItems($categoryId);

		if ($data['product']) {
			$data['title'] = $data['product']['name'];
		} else {
			$data['title'] = 'Product Not Found';
		}

		$this->prepareUserData();

		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu', $this->data);
		$this->load->view('partials/toast');
		$this->load->view('partials/alert');
		$this->load->view('catalog/view', $data);
		$this->load->view('partials/footer');
	}

	public function getCartTotal()
	{

		$cartTotal = $this->Cart->countCarts();

		echo $cartTotal;
	}
}
