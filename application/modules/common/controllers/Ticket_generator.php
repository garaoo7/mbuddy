<?php

class Ticket_generator extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("ticket_generator_model");
	}
	public function generate_ticket_user(){
		return $this->ticket_generator_model->getUserID();
	}

	public function generate_ticket_listing(){
		return $this->ticket_generator_model->getListingID();
	}

	public function generate_ticket_artist(){
		return $this->ticket_generator_model->getArtistID();
	}

	public function generate_ticket_composer(){
		return $this->ticket_generator_model->getComposerID();
	}

	public function generate_ticket_producer(){
		return $this->ticket_generator_model->getProducerID();
	}

	public function generate_ticket_section(){
		return $this->ticket_generator_model->getSectionID();
	}

	public function generate_ticket_writer(){
		return $this->ticket_generator_model->getWriterID();
	}

	public function generate_ticket_singer(){
		return $this->ticket_generator_model->getSingerID();
	}
}



  ?>