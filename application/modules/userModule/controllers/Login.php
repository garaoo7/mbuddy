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
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$userVerified = $this->userModel->userLogin($username, $password);
		$userActived = $this->userModel->userActived($username);
		if($userVerified && $userActived){
			$data = array(
				'username' => $this->input->post('username'),
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