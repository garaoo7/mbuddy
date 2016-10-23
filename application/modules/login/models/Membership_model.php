<?php

class Membership_model extends CI_Model {

	function validate()
	{
		print_r($_POST);
		$this->db->where('Username', $this->input->post('username'));
		$this->db->where('Password', $this->input->post('password'));
		$query = $this->db->get('user');
		echo $this->db->last_query();
		if($query->num_rows() ==1)
		{
			return true;
		}

	}

	function create_member(){
		$new_member_insert_data = array(
			'FirstName' => $this->load->post('first_name'),
			'LastName' => $this->load->post('last_name'),
			'Email' => $this->load->post('email_address'),
			'Username' => $this->load->post('username'),
			'Password' => $this->load->post('password')

			);
		$insert = $this->db->insert('user', $new_member_insert_data);
		return $insert;
	}

}
?>