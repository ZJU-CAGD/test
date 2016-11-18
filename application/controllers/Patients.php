<?php

class Patients extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Patients_model');
        $this->load->model('Treats_model');
        $this->load->model('Users_model');
		$this->load->helper ( array ('form','url') );
	}

    public function view($p_id = NULL, $username = NULL)
    {
        $data['patients_item'] = $this->Patients_model->get_patients($p_id);
        $data['treats_item'] = $this->Treats_model->get_treats($data['patients_item']['patient_id']);
        $query['users_item'] = $this->Users_model->get_users($username);
        
        //$data['username'] = $doctor_item['username'];
        $data['doctor_name'] = $query['users_item']['Doctor_name'];
        $data['username'] = $query['users_item']['username'];

        if (empty($data['patients_item']) || empty($query['users_item']) )
        {
            show_404();
        }
        $this->load->view('patient.html', $data);
    }

}
?>

