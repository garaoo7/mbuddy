<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_signup_page extends MX_Controller{

		public function __construct(){
		$this->load->model("user_model");
		$this->load->helper('security');
	}


	public function index(){
		$temp = $this->user_model->checkLoggedInUser();
		if($temp){
			header('Location: '."http://localhost/mbuddy/index.php/home_module/home/index");
		}
		else{
			$this->load->view("loginSignupPage");
		}
	}
	
}
?>