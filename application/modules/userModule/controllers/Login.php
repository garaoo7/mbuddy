<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller{

	public function __construct(){
		$this->load->model("userModel");
	}


	public function login(){
//backend validations and checks for user login

//**is function (is_ajax_request) safe, alternative of checking http request is not safe as well, refer "http://stackoverflow.com/questions/1756591/prevent-direct-access-to-file-called-by-ajax-function"
		if(!$this->input->is_ajax_request()) {
   				exit('No direct script access allowed');
		}
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		if($username == null || $username == ""){
			echo json_encode("Username field can not be empty");
			return;
		}
		if($password == null || $password == ""){
			echo json_encode("Password field can not be empty");
			return;
		}

		$result = $this->userModel->userLogin($username, $password);
		if($result == 'true'){
			$user = $this->userModel->userExist($username, 'username');
			$userID = $user->UserID;
			$data = array(
				'userID' 	=> $userID,
				'username' 	=> $username
			);
			$this->session->set_userdata($data);
			echo json_encode("true");
		}
		else if($result == 'false'){
			echo json_encode("incorrectCredentials");		
		}
		else if($result == 'notVerified'){
			echo json_encode("accountNotActivated");
		}
	}

	public function logout(){
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}
		$this->session->sess_destroy();
		echo json_encode("true");
	}
	
}
?>