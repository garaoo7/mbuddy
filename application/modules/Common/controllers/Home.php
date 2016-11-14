<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller{
	
	public function __construct(){
		$this->load->model("../modules/userModule/models/userModel");
	}
//home should be in different main controller (out of hmvc)
	public function index(){
		if($this->userModel->checkLoggedInUser()){
//**$data to displayData
			$displayData = array(
				'mainContent' => 'loggedInUser'
				);
			$this->load->view('../modules/userModule/views/template', $displayData);
		}
		else{
			$displayData['mainContent'] = 'homePage';
			$this->load->view('../modules/userModule/views/template', $displayData);
		}
	}
}



  ?>