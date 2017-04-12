<?php

class User_url {

	private $ci;
	private $userModel;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("user_module/user_model");
		$this->userModel = new user_model();
	}
//url_builder lib name
	//validate_url for below function

	public function getUserUrl($userId){
		//validate the user for the given userId
		$userName = $this->userModel->getUserName($userId);
		if($userName == false){
			return false;
		}
		else{
			//$url = convertTextToUrl($userName);
			return "profile/"."$userName/$userId";
		}

	}
}

?>