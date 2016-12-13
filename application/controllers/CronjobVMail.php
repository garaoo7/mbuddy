<?php
class CronjobVMail extends MX_Controller{
//**incomplete
	public function __construct(){
		$this->load->model("../modules/userModule/models/userModel");
	}

	public function cronjobVerificationMail(){
//updates the entry of EmailSent to YES when verification mail is successfully sent
		$this->userModel->_init('write');
		$this->userModel->dbHandle->select('Username, Email, Salt');
		$this->userModel->dbHandle->from('user');
		$this->userModel->dbHandle->where('EmailSent', 'NO');
		$user = $this->userModel->dbHandle->get();
		$user = $user->row();
		$username = $user->Username;
		$email = $user->Email;
		$salt = $user->Salt;
		$this->load->module('emailModule/sendverificationemail');
		if($this->sendverificationemail->sendVerificationMail($email, $username, $salt)){
			$this->userModel->emailSent($username);
		}
	}

}


?>