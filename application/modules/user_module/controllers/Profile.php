<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller{

	public function __construct(){
		$this->load->model("user_model");
	}

	public function index($userID = false){
		//check the default value of userID
		$this->load->builder('user_module/User_builder');
		$this->UserBuilder = new User_builder();
		$this->UserRepository = $this->UserBuilder->getUserRepository();
		$userObject = $this->UserRepository->find($userId, array('live'), array('full'));
		$displayData['userData'] = $userObject;
		$this->load->view("profilePage", $displayData);
		echo '<pre>'.print_r($userObject,TRUE).'</pre>';
	}
	
}
?>