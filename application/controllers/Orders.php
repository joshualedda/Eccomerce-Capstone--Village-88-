<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{

	public function index()
	{
		$this->prepareUserData();
		$this->redirectIfUnauthorized();
		$data['title'] = 'Orders';

		if ($this->input->is_ajax_request()) {
			$name = $this->input->post('name');
			$status = $this->input->post('status');

			$data['orders'] = $this->Order->getFilteredOrders($name, $status);
			$this->load->view('components/ordersTable', $data);
		} else {

			$data['orders'] = $this->Order->getOrders();
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar', $this->data);
			$this->load->view('partials/sidebar');
			$this->load->view('partials/toast');
			$this->load->view('admin/orders/index', $data);
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

	public function createOrder()
	{
		$result = $this->Order->addOrder();

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Orders Successfully Created'));
			} else {
				$this->session->set_flashdata('success_message', 'Orders Successfully Created');
				redirect('carts');
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				redirect('carts');
			}
		}
	}

	public function viewOrders()
	{
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

		$data['title'] = 'Track Order';
		$data['pendings'] = $this->Order->pendingOrders();
		$data['process'] = $this->Order->processOrders();
		$data['shipped'] = $this->Order->shippedOrders();
		$data['delivered'] = $this->Order->deliveredOrders();
		$data['cancelled'] = $this->Order->cancelledOrders();
		$data['refunds'] = $this->Order->refundOrders();

		$this->load->view('partials/header', $data);
		$this->load->view('partials/menu', $this->data);
		$this->load->view('orders/index');
		$this->load->view('partials/footer');
	}

	public function updateStatus()
	{
		$result = $this->Order->updateOrderStatus();

		if ($result) {
			echo json_encode(array('success' => true, 'message' => 'Status Updated Successfully'));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Error updating status'));
		}
	}
}
