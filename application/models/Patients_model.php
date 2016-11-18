<?php
class Patients_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_patients($patient_id = FALSE)
	{
		if ($patient_id === FALSE)
		{
			$query = $this->db->query("select * from patient order by last_check desc");
			return $query->result_array();
		}

		$query = $this->db->get_where('patient', array('patient_id' => $patient_id));
		return $query->row_array();
	}

	public function set_patients($data)
	{
		$this->load->helper('url');

		return $this->db->insert('patient', $data);
	}
}
?>