<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller{

	public function __construct(){
		$this->load->model("user_model");
		$this->load->helper('security');
		$this->load->helper('url');
	}


	public function login(){
//backend validations and checks for user login

//**is function (is_ajax_request) safe, alternative of checking http request is not safe as well, refer "http://stackoverflow.com/questions/1756591/prevent-direct-access-to-file-called-by-ajax-function"
		if(!$this->input->is_ajax_request()) {
   				exit('No direct script access allowed');
		}
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		// $windowUrl = $this->input->post('windowUrl', TRUE);
		if($username == null || $username == ""){
			echo json_encode("Username field can not be empty");
			return;
		}
		if($password == null || $password == ""){
			echo json_encode("Password field can not be empty");
			return;
		}

		$result = $this->user_model->userLogin($username, $password);
		if(isset($result->UserID)){
			$userID = $result->UserID;
			$data = array(
				'userID' 	=> $userID,
				'username' 	=> $username
			);
			$this->session->set_userdata($data);
			// parse_str( parse_Url( $windowUrl, PHP_URL_QUERY ), $my_array_of_vars );
			// $redirect = $my_array_of_vars['redirect'];
			// if($redirect = 'postingPage'){
			// 	header('Location: '."http://localhost/mbuddy/index.php/post_module/posting/index");
				// echo '<script type="text/javascript">
    //       				window.location.href = "http://localhost/mbuddy/index.php/post_module/posting/index"
	   //     			</script>';
			echo json_encode("true");

//redirect user according to the request parameter
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