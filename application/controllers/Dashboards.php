<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{
	public function index()
	{
		
		$data['title'] = 'Dashboard';
		$this->prepareUserData();
		$this->redirectIfUnauthorized();

        $data = $this->Order->getOrdersData();


		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $this->data);
		$this->load->view('partials/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('partials/footer');
	}

	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');
		$user_role = $this->session->userdata('role');

		$this->data['user_data'] = $user_data;
		$this->data['is_logged_in'] = $is_logged_in;
		$this->data['role'] = $user_role;
	}

	private function redirectIfUnauthorized()
	{
		if (!$this->data['is_logged_in'] || $this->data['role'] != 1) {
			$previous_url = $_SERVER['HTTP_REFERER'];
			redirect($previous_url);
		}
	}

	public function fetchOrdersData() {
		$data = $this->Order->getOrdersData();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	
private function formatChartData($data) {
    $formattedData = [];
    // Initialize formatted data array
    for ($month = 1; $month <= 12; $month++) {
        $formattedData[$month] = [];
        // Initialize data for each status
        for ($status = 0; $status <= 5; $status++) {
            $formattedData[$month][$status] = 0;
        }
    }
    // Fill in actual data
    foreach ($data as $row) {
        $formattedData[$row['month']][$row['status']] = intval($row['total_orders']);
    }
    return $formattedData;
}
}
