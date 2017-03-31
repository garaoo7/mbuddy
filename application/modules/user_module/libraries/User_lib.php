<?php

class User_lib{

	private $userModel;
// we might do call by reference for each input in each function below
	public function __construct($userModel){
		if(!empty($userModel)){
			$this->userModel = $userModel;
		}
	}

	public function getUserData($userId, $status = array('live'),$sections=array('basic')){
		$userData = false;
		if(empty($userId)){
			return $userData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->userModel->getUserData($userId,$status,$sections);
	}

	public function getMultipleUsersData($userIds, $status = array('live'),$sections=array('basic')){
		$usersData = false;
		if(empty($userIds)){ //check for array also
			return $usersData;
		}

		return $this->userModel->getMultipleUsersData($userIds,$status,$sections);
	}	
	
}
?>
