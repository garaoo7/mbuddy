<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller{

	public function __construct(){
		$this->load->library('user_module/user_url');
		$this->load->builder('user_module/User_builder');
		$this->UserBuilder = new User_builder();
		$this->UserRepository = $this->UserBuilder->getUserRepository();
		$this->load->helper('url');
		$this->userUrl = new user_url();
	}

	public function index($userId = false){
		$url = $this->userUrl->getUserUrl($userId);
		if($url == false){
			show_error_page();
		}
		else if(getRelativeUrl() != $url){
			redirect(MBUDDY_HOME.$url);
		}
		else{
			$userObject = $this->UserRepository->find($userId,array('full'));
			$displayData['userData'] = $userObject;
			_p($userObject);
			die;
			$this->load->view('profilePage', $displayData);

		}
	}
	
}
?>