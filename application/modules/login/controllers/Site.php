<?php 

class Site extends MX_Controller {

	//function _construct(){

	//	parent::MX_Controller();
	//	$this->is_logged_in();
	//}

	public function members_area(){
		$this->load->view('members_area');
	}

	//function is_logged_in(){
	//	$is_logged_in = $this->session->userdata('is_logged_in');
	//	if(isset($is_logged_in) || $is_logged_in !== true){
	//		echo 'Don\'t have permission';
	//		die();
	//	}
	//}

	
}
?>
