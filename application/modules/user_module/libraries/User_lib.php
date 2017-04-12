<?php

class User_lib{

	private $userModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct($userModel){
		if(!empty($userModel)){
			$this->userModel = $userModel;
		}
		$this->ci =& get_instance();
	}

	public function getSectionWiseUserData($userId,$sections){
		$userData = false;
		if(empty($userId)){
			return $userData;
		}

		return $this->userModel->getUserData($userId,$sections);
	}

	public function getSectionWiseMultipleUsersData($userIds,$sections){
		$usersData = array();
		if(empty($userIds) || !is_array($userIds) || count($userIds)==0){
			return $userData;
		}
		
		return $this->userModel->getMultipleUsersData($userIds,$sections);
	}
	
}
?>