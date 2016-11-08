<?php

class Signup extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
		$this->load->library('form_validation');
		$this->load->library('email_lib');
		$this->load->module('Common/Ticketgenerator');
		$this->load->helper('security');
	}


	public function index(){	
		$this->load->view("signupForm");
	}


	public function createUser(){
		
		
//Basic Validation Checks for the provided user credentials	
		$regxEmail = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
		$regxUsername = "/^[A-Za-z0-9]+$/";
		$username 	= $this->input->get('username', TRUE);
		$email 		= $this->input->get('emailAddress', TRUE);
		$password 	= $this->input->get('password', TRUE);
		$repassword = $this->input->get('repassword', TRUE);


		if($email == null || $email == ""){
      		echo json_encode("Email Address field can not be empty");
     	 	return false;
    	}

    	else if (!preg_match($regxEmail, $email)) {
        	echo json_encode('Email Address is invalid');
        	return false;
    	}

    	else if($username == null || $username == ""){
	      	echo json_encode('Username field can not be empty');
      		return false;
    	}
    	else if (!preg_match($regxUsername, $username)) {
	    	echo json_encode('Username field can only have aplha-numeric characters');
        	return false;
    	}
    
    	else if ($password == null || $password == "") {
	      	echo json_encode('Password field can not be empty');
      		return false;
    	}
    	else if($password != $repassword){
      		echo  json_encode("Passwords don't match");
      		return false;
    	}

			
			else if($checkUser = $this->userModel->userExist($username, 'username')){
				echo json_encode("usernameExist");
			}

			else if($checkUser = $this->userModel->userExist($email, 'email')){
					echo json_encode("emailExist");
				}
			
			else{
					$salt 	  = uniqid(mt_rand(), TRUE);
					$password = $this->userModel->hashPassword($password, $salt);
					$userId   = $this->ticketgenerator->generateTicket();

					if(4){
						if($this->email_lib->sendVerificationMail($email, $username, $salt))
						echo json_encode("true");
					}
					else{
						echo json_encode("false");
					}
				}
			}
		}
	

?>