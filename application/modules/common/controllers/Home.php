<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller{
	
	public function __construct(){
//simple path to user_model isn't working
		parent::__construct();
		$this->load->model("../modules/user_module/models/user_model");
	}
//home should be in different main controller (out of hmvc)
	public function index(){
		
		if($this->user_model->checkLoggedInUser()){
			$displayData = array(
				'session' => true
				);
		}
		else{
			$displayData = array(
				'session' => false
				);
		}
		$this->load->view('homepage', $displayData);
	}
}



  ?>