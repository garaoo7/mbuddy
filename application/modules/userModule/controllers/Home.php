<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
	}
//home should be in different main controller (out of hmvc)
	public function index(){
		if($this->userModel->checkLoggedInUser()){
			$data = array(
				'mainContent' => 'loggedInUser'
				);
			
			$this->load->view('includes/template', $data);
		}
		else{
			$data['mainContent'] = 'homePage';
			$this->load->view('includes/template', $data);
		}
	}
}



  ?>