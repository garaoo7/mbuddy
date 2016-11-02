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
			$checkUser = $this->userModel->userExist($_POST["username"]);

			if(isset($checkUser)){
				$this->index();
				echo "Username Already Exist";
			}
			else{
				$checkUser = $this->userModel->userExist($_POST["emailAddress"]);

				if(isset($checkUser)){
					$this->index();
					echo "Email Address Already Exist";
				}
				else{
					$salt = uniqid(mt_rand(), TRUE);
					$password = $this->userModel->hashPassword($_POST["password"], $salt);
					$data = array(
						'UserID' => "1",
						'FirstName' => $_POST["firstname"],
						'LastName' => $_POST["lastname"],
						'Email' => $_POST["emailAddress"],
						'Username' => $_POST["username"],
						'Password' => $password,
						'Salt' => $salt
						);

					if($this->userModel->userSignup($data)){
						$data = array(
							'username' => $_POST["username"],
							'isLoggedIn' => true
							);
						$this->session->set_userdata($data);
						$this->userModel->sendVerificationMail();
						redirect("userModule/home/welcomePage");
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