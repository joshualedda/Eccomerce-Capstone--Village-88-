<?php

class User extends CI_Model
{
	public $users = "users";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getUserById($user_id)
	{
		$sql = "SELECT * FROM users WHERE id = ?";

		$query = $this->db->query($sql, array($user_id));

		if ($query->num_rows() == 1) {
			return $query->row_array();
		}

		return null;
	}
	public function loginUser()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}
	
		$email = $this->security->xss_clean($this->input->post('email'));
		$password = $this->security->xss_clean($this->input->post('password'));
	
		$sql = "SELECT * FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));
	
		if ($query->num_rows() == 1) {
			$user = $query->row_array();
			$hashed_password = $user['password'];
	
			// Compare the hashed password
			if (password_verify($password, $hashed_password)) {
				return array('success' => true, 'user' => $user);
			}
		}
	
		return array('success' => false, 'error' => 'Invalid email or password.');
	}
	

	// Register User
	public function registerUser()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_repeat]');
		$this->form_validation->set_rules('password_repeat', 'Confirm Password', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$first_name = $this->security->xss_clean($this->input->post('first_name'));
			$last_name = $this->security->xss_clean($this->input->post('last_name'));
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));

			// Hash the password
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			// Prepare the SQL query
			$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
			$query_result = $this->db->query($sql, array($first_name, $last_name, $email, $hashed_password));

			if ($query_result) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error inserting user.');
			}
		}
	}
}
