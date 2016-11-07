<?php

class Home extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
	}

	public function index(){
		if($this->session->userdata('isLoggedIn')){
			$this->load->view("loggedInUser");
		}
		else{
			$this->load->view("homePage");
		}
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect("userModule/home/index");
	}
	
	public function verifyEmail($username, $salt){
		$user = $this->userModel->userExist($username, 'username');
		if($salt == md5($user->Salt)){	
			if($this->userModel->accountVerified($username)){
				redirect("userModule/home/index");
			}
		}
		else{
			echo "Permission Denied";
		}

	}
}



  ?>