<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ratings extends CI_Controller
{

	public function index($productId)
	{
		$this->prepareUserData();

		$data['ratings'] = $this->Rating->getUserRating($productId);

		$data['product'] = $this->Product->getProduct($productId);
		$data['image'] = $this->Product->getProductMainImage($productId);
		$data['user'] = $this->User->getUserName();

		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu', $this->data);
		$this->load->view('partials/alert');
		$this->load->view('partials/toast');
		$this->load->view('ratings/index', $data);
		$this->load->view('partials/footer');
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

	public function rate($productId)
	{
		$result = $this->Rating->createRating($productId);
		$data['product'] = $this->Product->getProduct($productId);
		$data['ratings'] = $this->Rating->getUserRating($productId);

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				$data['partialView'] = $this->load->view('components/ratingPartial', $data, true);
				echo json_encode(array('success' => true, 'message' => 'Successfully reviewed the item', 'partialView' => $data['partialView']));
			} else {
				$this->session->set_flashdata('success_message', 'Successfully reviewed the item');
				redirect('rate/product/' . $productId);
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				$this->index($productId);
			}
		}
	}
	

}
