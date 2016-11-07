<?php

class Ticketgenerator extends MX_Controller{
	
	public function generateTicket(){
		$this->load->model('TicketGeneratorModel');
		$this->TicketGeneratorModel->getUserID();
	}
}



  ?>