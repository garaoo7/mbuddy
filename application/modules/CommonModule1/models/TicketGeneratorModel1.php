<?php

class TicketGeneratorModel extends CI_Model{

	public function getUserID(){
		echo "sad";
		return;
		$query = "REPLACE INTO user_registration (Temp) VALUES ('a')";
		$user = $this->db->query($query);
		return $this->db->insert_id();
		}

}



 ?>