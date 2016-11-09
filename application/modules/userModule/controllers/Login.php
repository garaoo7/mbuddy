<?php

class Login extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
	}

	public function index(){
		if($this->session->userdata('isLoggedIn')){
			$this->load->view("loggedInUser");
		}
		else{
			$this->load->view("loginForm");
		}
	}

	public function login(){
		$username = $this->input->get('username', TRUE);
		$password = $this->input->get('password', TRUE);
		if($this->userModel->userLogin($username, $password)){
			if($this->userModel->userActivated($username)){
				$data = array(
				'username' => $username,
				'isLoggedIn' => true
				);
			
			$this->session->set_userdata($data);
			echo json_encode("true");
			}
			else{
				echo json_encode("accountNotActivated");
			}
		}
		else{
			echo json_encode("incorrectCredentials");
		}

	}
	
}
?>