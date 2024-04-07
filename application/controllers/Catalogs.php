<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catalogs extends CI_Controller
{
	public function index()
	{
		$recordsPerPage = 5;
		$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
		$offset = ($currentPage - 1) * $recordsPerPage;

		if ($this->input->is_ajax_request()) {
			$name = $this->input->post('name');
			$category = $this->input->post('category');
			$priceOrder = $this->input->post('price_order');

			$data['products'] = $this->Product->filterCatalog($name, $category, $priceOrder);
			$this->load->view('components/catalogsPartial', $data);
			$this->load->view('partials/footer');
		} else {

			$data['products'] = $this->getProductsWithRatings($recordsPerPage, $offset);
			$totalCategories = $this->Product->countProducts();
			$totalPages = ceil($totalCategories / $recordsPerPage);
			$data['pagination'] = [
				'currentPage' => $currentPage,
				'totalPages' => $totalPages
			];

			$data['categories'] = $this->Category->getCategories();

			$this->prepareUserData();
			$this->data['cartsTotal'] = $this->Cart->countCarts();
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

		$data['ratings'] = $this->Rating->getProductRatings($productId);

		$data['averageRating'] = $this->calculateAverageRating($data['ratings']);

		foreach ($data['ratings'] as &$review) {
			$rating_id = $review['ratingId'];
			$review['replies'] = $this->Reply->getReviewReplies($rating_id);
		}

		foreach ($data['ratings'] as &$rating) {
			$rating['formattedDate'] = !empty($rating['ratingsCreated']) ? $this->formatRatingDate($rating['ratingsCreated']) : '';
			$rating_id = $rating['ratingId'];
			$rating['replies'] = $this->Reply->getReviewReplies($rating_id);
		}

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

	public function formatRatingDate($ratingCreated)
	{
		$ratingDate = new DateTime($ratingCreated);
		$currentDate = new DateTime();
		$interval = $currentDate->diff($ratingDate);

		if ($interval->days < 1) { 
			if ($interval->h < 1) { 
				return $interval->format('%i minutes ago');
			} else {
				return $interval->format('%h hours %i minutes ago');
			}
		} elseif ($interval->days < 7) { 
			return $interval->format('%a days ago');
		} else { 
			return date('F j, Y H:i:s', strtotime($ratingCreated));
		}
	}

	private function calculateAverageRating($ratings)
	{
		$totalRatings = count($ratings);
		$sumRatings = array_reduce($ratings, function ($carry, $rating) {
			return $carry + $rating['rating'];
		}, 0);
		return ($totalRatings > 0) ? round($sumRatings / $totalRatings, 1) : 0;
	}

	public function getProductsWithRatings($recordsPerPage, $offset)
	{
		$products = $this->Product->getProductsWithMainImages($recordsPerPage, $offset);

		foreach ($products as &$product) {
			$productId = $product['productId'];
			$product['ratings'] = $this->Rating->getProductRatings($productId);
			$product['averageRating'] = $this->calculateAverageRating($product['ratings']);
		}

		return $products;
	}



	public function getCartTotal()
	{

		$cartTotal = $this->Cart->countCarts();

		echo $cartTotal;
	}
}
