<?php

class Ticketgenerator extends MX_Controller{
	public function __construct(){
		$this->load->model('ticketGeneratorModel');
	}

	public function index(){
		echo "hi";
	}
	public function generateTicket(){
	//	return $this->ticketGeneratorModel->getUserID();
	echo "asdasd";
	}

}



 ?>
