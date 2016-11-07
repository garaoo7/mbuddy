<?php

class Ticketgenerator extends MX_Controller{
	public function __construct(){
		$this->load->model('TicketGeneratorModel');
	}
	public function generateTicket(){
		$this->TicketGeneratorModel->getUserID();
	}

}



 ?>
