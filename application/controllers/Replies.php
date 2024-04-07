<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Replies extends CI_Controller
{

	public function reply($productId)
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

		$result = $this->Reply->createReply($productId);

		if ($result['success']) {


			$data['ratings'] = $this->Rating->getProductRatings($productId);
	
			foreach ($data['ratings'] as &$review) {
				$rating_id = $review['ratingId'];
				$review['replies'] = $this->Reply->getReviewReplies($rating_id);
			}
	
			foreach ($data['ratings'] as &$rating) {
				$rating['formattedDate'] = !empty($rating['ratingsCreated']) ? $this->formatRatingDate($rating['ratingsCreated']) : '';
				$rating_id = $rating['ratingId'];
				$rating['replies'] = $this->Reply->getReviewReplies($rating_id);
			}


			if ($this->input->is_ajax_request()) {
				$data['partialView'] = $this->load->view('components/replyPartial', $data, true);
				echo json_encode(array('success' => true, 'message' => 'Successfully replied', 'partialView' => $data['partialView']));
			} else {
				$this->session->set_flashdata('success_message', 'Successfully replied');
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

}
