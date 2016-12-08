<?php

class TicketGeneratorModel extends CI_Model{

	public function getUserID(){
		$query = "REPLACE INTO tickets_user (Temp) VALUES ('a')";
		$user = $this->db->query($query);
		return $this->db->insert_id();
		}

	public function getListingID(){
		$query = "REPLACE INTO tickets_listing (Temp) VALUES ('a')";
		$user = $this->db->query($query);
		return $this->db->insert_id();
		}

}



 ?>