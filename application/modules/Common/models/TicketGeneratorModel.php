<?php

class TicketGeneratorModel extends MY_Model{

	public function getUserID(){
		$query = "REPLACE INTO tickets_user (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getListingID(){
		$query = "REPLACE INTO tickets_listing (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getArtistID(){
		$query = "REPLACE INTO tickets_artist (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getComposerID(){
		$query = "REPLACE INTO tickets_composer (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getProducerID(){
		$query = "REPLACE INTO tickets_producer (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getSectionID(){
		$query = "REPLACE INTO tickets_section (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getWriterID(){
		$query = "REPLACE INTO tickets_writer (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

	public function getSingerID(){
		$query = "REPLACE INTO tickets_singer (Temp) VALUES ('a')";
		$this->db->query($query);
		return $this->db->insert_id();
	}

}



 ?>