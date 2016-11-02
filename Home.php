<?php

class Home extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
	}

	public function index(){
		//$this->session->sess_destroy();
		$this->load->view("homePage");
	}

	public function welcomePage(){
		if($this->session->userdata('isLoggedIn')){
			$this->load->view("loggedInUser");
		}
		else{
			redirect("userModule/home/index");
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("userModule/home/index");
	}
	
	public function verifyEmail($hash=NULL){
		if($this->userModel->accountVerified($hash)){
			redirect("userModule/home/index");
		}

	}
}



  ?>