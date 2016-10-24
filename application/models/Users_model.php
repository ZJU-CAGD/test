<?php
class Users_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function get_users($username)
	{
		$query = $this->db->get_where('users', array('username' => $username));

		return $query->row_array();
	}

	public function set_users()
	{
		$this->load->helper('url');

		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'birthday' => $this->input->post('birthday'),
			'sex' => $this->input->post('sex'),
		);

		return $this->db->insert('users', $data);
	}
}
?>