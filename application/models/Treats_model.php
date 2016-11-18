<?php
class Treats_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_treats($patient_id = FALSE)
	{
		if ($patient_id === FALSE)
		{
			$query = $this->db->query("select * from Treat order by treat_date desc");
			return $query->result_array();
		}

		$query = $this->db->query("select * from Treat where belongs_to_patientID = '$patient_id' order by treat_date desc");
		return $query->result_array();
	}

    public function get_doctor_treats($doctor_id)
    {
        if ($doctor_id)
        {
            $query = $this->db->query("select * from Treat where doctor_id = '$doctor_id' order by treat_date desc");
			return $query->result_array();
        }
    }

	public function set_patients($data)
	{
		$this->load->helper('url');

		return $this->db->insert('patient', $data);
	}
}
?>