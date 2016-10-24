<?php

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->helper ( array ('form','url') );
		//$this->load->library('session');
	}

	public function index() {
		$this->load->view('users/index');
	}

	public function user_login() {
		$this->load->library ( 'form_validation' );

		$this->form_validation->set_rules ( 'username', 'username', 'required' );
		$this->form_validation->set_rules ( 'password', 'password', 'required' );

		if ($this->form_validation->run () == FALSE) {
			$this->load->view ( 'users/login' );
		} 
		else
        {
        	$data = array (
				'username' => $_POST ['username'],
				'password' => md5($_POST ['password'])
			);
			$newdata = array(
				'username'  =>  $data ['username'] ,
				'userip'    =>  $_SERVER['REMOTE_ADDR'],
				'luptime'   =>  time()
			);

			$query['users_item'] = $this->Users_model->get_users($data['username']);

			if (empty($query['users_item']))
			{
				echo 'haha';
			}
			else
			{
				if ($query['users_item']['password'] == $data['password'])
				{
					//$this->session->set_userdata($newdata);
					$this->load->view ('users/usercenter', $data);
				}
				else
				{	
					//$this->session->sess_destroy();
					//show_404();
					echo $data['password'];
					echo $query['users_item']['password'];
				}
			}
        }
	}

	public function user_register() {
		$this->load->library ( 'form_validation' );

		$this->form_validation->set_rules ( 'username', 'username', 'required' );
		$this->form_validation->set_rules ( 'password', 'password', 'required' );
		$this->form_validation->set_rules ( 'birthday', 'birthday', 'required' );
		$this->form_validation->set_rules ( 'sex', 'sex', 'required' );

		if ($this->form_validation->run () == FALSE) {
			$this->load->view ( 'users/register' );
		} 
		else
        {
        	$data = array (
				'username' => $_POST ['username'],
				'password' => md5($_POST ['password'])
			);
			$newdata = array(
				'username'  =>  $data ['username'] ,
				'userip'    =>  $_SERVER['REMOTE_ADDR'],
				'luptime'   =>  time()
			);
			//$this->session->set_userdata($newdata);
			$this->Users_model->set_users();
			$this->load->view ('users/usercenter', $data);
        }
	}
}
?>