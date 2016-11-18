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
			'password' => $this->input->post('password')
		);
		return $this->db->insert('users', $data);
	}

	public function update_password()
	{
		$this->load->helper('url');
		$data = array(
			'password' => $this->input->post('password2')
		);
		return $this->db->update( 'users', $data, array('username' => $this->input->post('username')) );
	}
}
?>