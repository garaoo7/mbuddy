<?php

class Nofunsss extends MX_Controller{

	public function sayhello(){
		$this->load->model('TicketGeneratorModel');
		$this->TicketGeneratorModel->getUserID();
		echo "sad";
	}
}



  ?>