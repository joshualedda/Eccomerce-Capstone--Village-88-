<?php

class Reply extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function createReply()
	{
		$this->form_validation->set_rules('review_id', 'Review', 'required');
		$this->form_validation->set_rules('reply', 'Reply', 'required');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$review_id = $this->security->xss_clean($this->input->post('review_id'));
			$reply = $this->security->xss_clean($this->input->post('reply'));
			$user_id = $this->session->userdata('id');

			$sql = "INSERT INTO replies (user_id, rating_id, comment) VALUES (?, ?, ?)";
			$query_result = $this->db->query($sql, array($user_id, $review_id, $reply));

			if ($query_result) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error inserting category.');
			}
		}
	}

	public function getReviewReplies($rating_id)
	{
		$sql = 'SELECT replies.created_at AS replyCreated,
				replies.comment as replyComment,
				replies.id AS replyId,
				CONCAT(users.first_name, " ", users.last_name) AS UserName 
				FROM replies
				LEFT JOIN users ON users.id = replies.user_id
				WHERE replies.rating_id = ?
				ORDER BY replies.created_at DESC';
	
		$query = $this->db->query($sql, array($rating_id));
		return $query->result_array();
	}
	

}
