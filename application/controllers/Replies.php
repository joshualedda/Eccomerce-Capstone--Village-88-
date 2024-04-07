<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Replies extends CI_Controller
{
	public function reply()
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

		
		$result = $this->Reply->createReply();

		if ($result['success']) {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => true, 'message' => 'Succesfully Reply'));
			} else {
				$this->session->set_flashdata('success_message', 'Succesfully Reply');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode(array('success' => false, 'message' => $result['error']));
			} else {
				$data['error_message'] = $result['error'];
				$this->session->set_flashdata('error_message', $result['error']);
			}
			redirect($_SERVER['HTTP_REFERER']);

		}
	}
}
