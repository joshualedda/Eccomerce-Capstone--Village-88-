<?php

class Rating extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function createRating($productId)
	{
		$this->form_validation->set_rules('rating', 'Rating', 'required');
		$this->form_validation->set_rules('comment', 'Review', 'required');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$rating = $this->security->xss_clean($this->input->post('rating'));
			$comment = $this->security->xss_clean($this->input->post('comment'));
			$user_id = $this->session->userdata('id');

			$sql = "SELECT * FROM ratings WHERE product_id = ? AND user_id = ?";
			$query = $this->db->query($sql, array($productId, $user_id));

			if ($query->num_rows() > 0) {
				return array('success' => false, 'error' => 'You already posted a review.');
			}

			$sql = "INSERT INTO ratings (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)";
			$query_result = $this->db->query($sql, array($user_id, $productId, $rating, $comment));

			if ($query_result) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error inserting category.');
			}
		}
	}

	public function getUserRating($productId)
	{
		$userId = $this->session->userdata('id');

		$sql = 'SELECT * FROM ratings WHERE product_id = ? AND user_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($productId, $userId));
		return $query->row_array();
	}

	public function getProductRatings($productId)
	{
		$sql = 'SELECT ratings.*,  
				ratings.created_at AS ratingsCreated,
				ratings.id AS ratingId,
				CONCAT(users.first_name, " ", users.last_name) AS UserName 
				FROM ratings
				LEFT JOIN users
				ON users.id = ratings.user_id
				WHERE ratings.product_id = ?';
		$query = $this->db->query($sql, array($productId));
		return $query->result_array();
	}
	
	


}
