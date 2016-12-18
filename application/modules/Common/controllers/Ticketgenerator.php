<?php

class Ticketgenerator extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("ticketGeneratorModel");
	}
	public function generateTicketUser(){
		return $this->ticketGeneratorModel->getUserID();
	}

	public function generateTicketListing(){
		return $this->ticketGeneratorModel->getListingID();
	}

	public function generateTicketArtist(){
		return $this->ticketGeneratorModel->getArtistID();
	}

	public function generateTicketComposer(){
		return $this->ticketGeneratorModel->getComposerID();
	}

	public function generateTicketProducer(){
		return $this->ticketGeneratorModel->getProducerID();
	}

	public function generateTicketSection(){
		return $this->ticketGeneratorModel->getSectionID();
	}

	public function generateTicketWriter(){
		return $this->ticketGeneratorModel->getWriterID();
	}

	public function generateTicketSinger(){
		return $this->ticketGeneratorModel->getSingerID();
	}
}



  ?>