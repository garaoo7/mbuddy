<?php

class Signup extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
		$this->load->library('form_validation');
	}


	public function index(){
		$this->load->view("signupForm");
	}


	public function createUser(){
//Basic Validation Checks for the provided user credentials	

		$this->form_validation->set_rules("firstname", "First Name", "trim|required");
		$this->form_validation->set_rules("lastname", "Last Name", "trim|required");
		$this->form_validation->set_rules("username", "Username", "trim|required|alpha_dash");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_rules("repassword", "Password Confirmation", "trim|required|matches[password]");
		$this->form_validation->set_rules("emailAddress", "Email Address", "trim|required|valid_email");

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$checkUser = $this->userModel->userExist($this->input->post('username'), 'username');

			if(isset($checkUser)){
				$this->index();
				echo "Username Already Exist";
			}
			else{
				$checkUser = $this->userModel->userExist($this->input->post('emailAddress'), 'email');

				if(isset($checkUser)){
					$this->index();
					echo "Email Address Already Exist";
				}
				else{
					$salt = uniqid(mt_rand(), TRUE);
					$password = $this->userModel->hashPassword($this->input->post('password'), $salt);
					$lastUserId = $this->userModel->lastInsertUserId();
					$UserId = $lastUserId + 1;
					$data = array(
						'UserID' => $UserId,
						'FirstName' => $this->input->post('firstname'),
						'LastName' => $this->input->post('lastname'),
						'Email' => $this->input->post('emailAddress'),
						'Username' => $this->input->post('username'),
						'Password' => $password,
						'Salt' => $salt
					);

//use below query for insertion
//insert into user (userid,email) values(select max userid from user)+1;
					if($this->userModel->userSignup($data)){
						$this->userModel->sendVerificationMail($data['Email'], $data['Username'], $data['Salt']);
						redirect("userModule/home/index");
					}
					else{
						$this->index();
						echo "Unknown Error Occured, Try Again";
					}
				}
			}
		}
	}


}

?>