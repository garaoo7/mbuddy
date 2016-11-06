<?php

class Login extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
		$this->load->library('form_validation');

	}

	public function loginPage(){
		$this->load->view("loginForm");
	}

	public function loginData(){
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$userVerified = $this->userModel->userVerification($username, $password);
		if($userVerified){
			redirect("userModule/home/welcomePage");
		}
		else{
			$this->loginPage();
		}
	}

	public function signup(){
		$this->load->view("signupForm");
	}


	public function createUser(){
//Basic Validation Checks for the provided user credentials	

		$this->form_validation->set_rules("firstname", "First Name", "trim|required");
		$this->form_validation->set_rules("lastname", "Last Name", "trim|required");
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_rules("repassword", "Password Confirmation", "trim|required|matches[password]");
		$this->form_validation->set_rules("emailAddress", "Email Address", "trim|required|valid_email");

		if($this->form_validation->run() == FALSE){
			$this->signup();
		}
		else{
//Password hashing using salt			
			$salt = uniqid('', TRUE);
			$password = md5($_POST['password']);
			$password = md5($password.$salt);
			if($this->userModel->userSignup($password, $salt)){
				redirect("userModule/home/welcomePage");
			}
			else{
				$this->signup();
				echo "Existing Username or Email";
			}

		}

	}
	
}



  ?>