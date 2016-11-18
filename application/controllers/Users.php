<?php

class Users extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Patients_model');
		$this->load->helper ( array ('form','url') );
		$this->load->library('session');
	}

	public function index() 
	{
		$this->load->view('login.html');
	}

	public function login_in() 
	{
		$this->load->library ( 'form_validation' );

		$this->form_validation->set_rules ( 'username', 'username', 'required' );
		$this->form_validation->set_rules ( 'password', 'password', 'required' );

		if ($this->form_validation->run () == FALSE) 
		{
			$this->load->view ( 'login.html' );
		} 
		else
        {
        	$data = array (
				'username' => $_POST ['username'],
				'password' => $_POST ['password']
			);
			$newdata = array(
				'username'  =>  $data ['username'] ,
				'userip'    =>  $_SERVER['REMOTE_ADDR'],
				'luptime'   =>  time()
			);

			$query['users_item'] = $this->Users_model->get_users($data['username']);

			if (empty($query['users_item']))
			{
?>
				<script>
					alert('数据库中没有该用户名!');
					window.history.back();
				</script>
<?php
			}
			else
			{
				if ($query['users_item']['password'] == $data['password'])
				{
					$this->session->set_userdata($newdata);
					$data['patients'] = $this->Patients_model->get_patients();
					$data['doctor_name'] = $query['users_item']['Doctor_name'];
					$this->load->view ('index.html', $data);
				}
				else
				{	
					$this->session->sess_destroy();
?>
					<script>
					alert('密码不正确!');
					window.history.back();
					</script>
<?php 
					//echo $data['password'];
					//echo $query['users_item']['password'];
				}
			}
        }
	}

	public function login_out() 
	{
		$this->load->view( 'login.html' );
	}

	public function forget_password()
	{
		$this->load->view( 'password.html' );
	}

	public function profile($username = NULL)
	{
		$data['users_item'] = $this->Users_model->get_users($username);

        if (empty($data['users_item']))
        {
            show_404();
        }

		$this->load->view( 'profile.html', $data );
	}

	public function contacts()
	{
		$this->load->view( 'contact.html' );
	}

	public function change_password() {
		$this->load->library ( 'form_validation' );

		$this->form_validation->set_rules ( 'username', 'username', 'required' );
		$this->form_validation->set_rules ( 'password1', 'password1', 'required' );
		$this->form_validation->set_rules ( 'password2', 'password2', 'required' );
		$this->form_validation->set_rules ( 'password3', 'password3', 'required' );

		if ($this->form_validation->run () == FALSE) {
			$this->load->view ( 'contact.html' );
		} 
		else
        {	
        	$data = array (
				'username' => $_POST['username'],
				'password1' => $_POST ['password1'],
				'password2' => $_POST ['password2'],
				'password3' => $_POST ['password3']
			);
			$newdata = array(
				'username'  =>  $data ['username'] ,
				'userip'    =>  $_SERVER['REMOTE_ADDR'],
				'luptime'   =>  time()
			);
			$query['users_item'] = $this->Users_model->get_users($data['username']);
			if (empty($query['users_item']))
			{
?>
				<script>
					alert('数据库中没有该用户名!');
					window.history.back();
				</script>
<?php
			}
			else
			{
				if ($query['users_item']['password'] != $data['password1'])
				{
					$this->session->sess_destroy();
?>
					<script>
					alert('您输入的原密码不正确!');
					window.history.back();
					</script>
<?php 
				}
				else
				{
					if ( $data['password2'] != $data['password3'])
					{
						$this->session->sess_destroy();
?>
					<script>
					alert('您两次输入的密码不一致!');
					window.history.back();
					</script>
<?php 
					}
					else
					{
?>
					<script>
					alert('修改密码成功!');
					</script>
<?php 
					$this->session->set_userdata($newdata);
					$this->Users_model->update_password();
					}	
				}
			}
			$data['patients'] = $this->Patients_model->get_patients();
			$data['doctor_name'] = $query['users_item']['Doctor_name'];
			$this->load->view ('index.html', $data);
        }
	}

}
?>

