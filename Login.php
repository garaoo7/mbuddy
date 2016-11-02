<?php

class Login extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
	}

	public function index(){
		$this->load->view("loginForm");
	}

	public function login(){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$userVerified = $this->userModel->userLogin($username, $password);
		$userActived = $this->userModel->userActived($username);
		if($userVerified && $userActived){
			$data = array(
				'username' => $_POST["username"],
				'isLoggedIn' => true
				);
			$this->session->set_userdata($data);
			redirect("userModule/home/welcomePage");
		}
		else{
			$this->index();
		}
	}
	
}
?>