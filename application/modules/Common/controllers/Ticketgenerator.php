<?php

class Ticketgenerator extends MX_Controller{
	
	public function generateTicketUser(){
		$this->load->model('TicketGeneratorModel');
		return $this->TicketGeneratorModel->getUserID();
	}

	public function generateTicketListing(){
		$this->load->model('TicketGeneratorModel');
		return $this->TicketGeneratorModel->getListingID();
	}
}



  ?>