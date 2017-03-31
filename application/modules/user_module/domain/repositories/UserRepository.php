<?php

class UserRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $userModel;
    private $userLib;
    public function __construct($userModel,$userLib) {
		parent::__construct();
		if(!empty($userModel) && !empty($userLib)){
			$this->userModel = $userModel;
			$this->userLib   = $userLib;
		}
	}
	
	public function find($userId = NULL, $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$userObject 	= false;
		if(empty($userId)){
            return $userObject;
		}
		//$this->_validateSections($sections);
		$userData = $this->userLib->getUserData($userId,$status,$sections);
		return $this->_populateUserObject($userData);
	}


	public function findMultiple($userIds = array(), $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$userObjects 	= false;
		if(empty($userIds)){//check for array also
            return $userObjects;
		}
		// $this->_validateSections($sections);
		$usersData = $this->userLib->getMultipleUsersData($userIds,$status,$sections);
		/*
        */
        return $this->_populateMultipleUsersObjects($usersData,$userIds,$sections);
	}
	private function _populateUserObject($userData,$sections=array('basic')){
		//creating too many unwanted variables if basic is required, solution might be to use 2 entites
		$userObjectData 					= array();
		$userObjectData['UserID'] 			= $userData['UserID'];
		$userObjectData['Username'] 		= $userData['Username'];
		$userObjectData['FirstName'] 		= $userData['FirstName'];
		$userObjectData['LastName'] 		= $userData['LastName'];
		$userObjectData['DateOfBirth'] 		= $userData['DateOfBirth'];
		$userObjectData['Gender'] 			= $userData['Gender'];
		$userObjectData['City'] 			= $userData['CityName'];
		$userObjectData['Country'] 			= $userData['CountryName'];
		$userObjectData['Mobile'] 			= $userData['Mobile'];
		$userObjectData['FollowersCount'] 	= $userData['FollowersCount'];
		$userObjectData['FollowingCount'] 	= $userData['FollowingCount'];
		$userObjectData['TagsCount'] 		= $userData['TagsCount'];
		$userObjectData['AboutMe'] 			= $userData['AboutMe'];
		
        $userObject = new user();
        //print_r($userObjectData);
        $this->fillObjectWithData($userObject,$userObjectData);
        return $userObject;
	}

	private function _populateMultipleUsersObjects($usersData,$userIds,$sections=array('basic')){
		$userObjects = array();
		foreach ($userIds as $userId) {
			if(isset($usersData[$userId])){
				$userObjects[$userId] = $this->_populateUserObject($usersData[$userId],$sections);
			}
		}
		return $userObjects;
	}

}
