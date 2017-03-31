<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends MX_Controller{

	public function __construct(){
		$this->load->model("user_model");
//		$this->load->library('form_validation');
		$this->load->helper('security');
	}


	public function create_user(){	
//backend validations and checks for adding new user to database
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}
		
		$regxEmail 		= "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
		$regxUsername 	= "/^[A-Za-z0-9\-\_]+$/";
		$username 		= $this->input->post('username', TRUE);
		$email 			= $this->input->post('emailAddress', TRUE);
		$password 		= $this->input->post('password', TRUE);
		$repassword 	= $this->input->post('repassword', TRUE);


		if($email == null || $email == ""){
      		echo json_encode("Email Address field can not be empty");
     	 	return false;
    	}
    	else if(!preg_match($regxEmail, $email)){
        	echo json_encode('Email Address is invalid');
        	return false;
    	}

    	else if($username == null || $username == ""){
	      	echo json_encode('Username field can not be empty');
      		return false;
    	}
    	else if(!preg_match($regxUsername, $username)){
	    	echo json_encode('Username field can only have aplha-numeric characters, hyphens and underscores');
        	return false;
    	}
    	else if($password == null || $password == ""){
	      	echo json_encode('Password field can not be empty');
      		return false;
    	}
    	else if($password != $repassword){
      		echo  json_encode("Passwords don't match");
      		return false;
    	}

    	$checkUser = $this->user_model->userExist($email, 'email');
    	if($checkUser){
		// if($checkUser && ($checkUser->Status != 'deleted')){
			echo json_encode("emailExist");
			return false;
		}

		$checkUser = $this->user_model->userExist($username, 'username');
		if($checkUser){
		// if($checkUser && ($checkUser->Status != 'deleted')){		
			echo json_encode("usernameExist");
			return false;
		}
		
		$this->load->module('common/ticket_generator');
		$salt 	  	= uniqid(mt_rand(), TRUE);
		$password 	= $this->user_model->hashPassword($password, $salt);
		$userID   	= $this->ticket_generator->generate_ticket_user();
		$data 		= array(
				'UserID' 	=> $userID,
				'Email' 	=> $email,
				'Username' 	=> $username,
				'Password' 	=> $password,
				'Salt' 		=> $salt
				);
		if($this->user_model->userSignup($data)){
			$this->load->module('email_module/send_verification_email');
			if($this->send_verification_email->send_verification_mail($email, $username, $salt)){
				$this->user_model->emailSent($username);							
			}
			echo json_encode("true");
		}
		else{
			echo json_encode("false");
		}
		
	}
}
?>