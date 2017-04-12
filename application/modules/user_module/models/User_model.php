<?php
	
class User_model extends MY_Model{

	private $dbHandle;
	private function _init($handle = 'read'){
//directs the database requests to specific servers(hostnames), different for read and write.
		if($handle=='read'){
			$this->dbHandle = $this->getReadHandle();
		}
		else if($handle=='write'){
			$this->dbHandle = $this->getWriteHandle();
		}
	}

	public function userExist($value, $type = NULL){
//check if a user entry exists in the database and returns the row entry if he exists
		$this->_init('read');
		$this->dbHandle->select('UserID, Username, Password, Email, Status, Salt');
		$this->dbHandle->from('user');
		if($type == 'email'){
			$this->dbHandle->where('Email', $value);
		}
		else if($type == 'username'){
			$this->dbHandle->where('Username', $value);
		}
		else{
			$this->dbHandle->where('Email', $value);
			$this->dbHandle->or_where('Username', $value);
		}

		$user = $this->dbHandle->get();
		if($user->num_rows() > 0){
			$user = $user->row();
			return $user;
		}
		//echo $this->dbHandle->last_query();
		return false;
	}

	public function userLogin($username, $password){
//verifies the user credentials when he attempts to login
		$user = $this->userExist($username);
		if($user){
			$status = $user->Status;
			if($status!='deleted'){
				$salt = $user->Salt;
				$password = $this->hashPassword($password, $salt);
				if($password == $user->Password){
					if($status == 'live'){
						return $user;
					}
					else{
						return 'notVerified';
					}
				}
				else{
					return 'false';
				}
			}
			else{
				return 'false';
			}
		}
		else{
			return 'false';
//not existing account also returns false (same as incorrect password), so that no one could take advantage of knowing which username exists in our database and which does not.
		}
	}

	public function checkLoggedInUser(){
//checks if the user is logged in via accessing session data.
		$username = $this->session->userdata('username');
		if(isset($username)){
			return true;
		}
		else{
			return false;
		}
	}

	public function userSignup($data){ 
//inserts the new user data into database
		$this->_init('write');
		return $this->dbHandle->insert('user', $data);
	}

	public function hashPassword($password, $salt){
//hashes the password with the salt and returns secured password
		$password = utf8_encode($password);
		$salt     = utf8_encode($salt);
		$password = md5($password);
		$password = md5($password.$salt);
		$password = base64_encode($password);
		return $password;
	}

	public function emailSent($username){
//updates the entry of EmailSent to YES when verification mail is successfully sent
		$this->_init('write');
		$this->dbHandle->where('Username', $username);
			$data = array(
	        	'EmailSent' => 'YES'
			);
		return $this->dbHandle->update('user', $data);
	}

	public function accountVerified($username){
//set user status to live when the user verifies his mail address
		$this->_init('write');
		$this->dbHandle->where('Username', $username);
		$data = array(
        	'Status' => 'live'
		);
		return $this->dbHandle->update('user', $data);
	}

// 	public function cronjobVerificationEmail(){
// //updates the entry of EmailSent to YES when verification mail is successfully sent
// 		$this->_init('write');
// 		$this->dbHandle->select('Username, Email, Salt');
// 		$this->dbHandle->from('user');
// 		$this->dbHandle->where('EmailSent', 'NO');
// 		$user = $this->dbHandle->get();
// 		$user = $user->row();
// 		$username = $user->Username;
// 		$email = $user->Email;
// 		$salt = $user->Salt;
// 		$this->load->module('emailModule/sendverificationemail');
// 		if($this->sendverificationemail->sendVerificationMail($email, $username, $salt)){
// 			$this->emailSent($username);
// 		}
// 		return;
// 	}
	public function getUserData($userId,$sections=array('basic'),$status = array('live')){
//used for domain
		$userId = array($userId);
		$data = $this->getMultipleUsersData($userId,$sections);
		return $data[current($userId)];
	}

	public function getMultipleUsersData($userIds = array(),$sections=array('basic'),$status = array('live')){
//used for domain

		$this->_init('read');
		$returnArray    = array();

		if(in_array('basic', $sections)){

			$this->dbHandle->select('UserID,Username,FirstName,LastName');

			$this->dbHandle->from('user');

			$this->dbHandle->where_in('UserID',$userIds);

			$this->dbHandle->where_in('Status',$status);

			$userResults = $this->dbHandle->get()->result_array();

		 	foreach ($userResults as $userResult){
		 		$returnArray[$userResult['UserID']]['basic'] = $userResult;
		 	}
		}

		else if(in_array('fullInfo', $sections)){

			$this->dbHandle->select('	UserID,
										Username,
										Email,
										FirstName,
										LastName,
										DateOfBirth,
										Gender,
										Mobile,
										FollowersCount,
										FollowingCount,
										TagsCount,
										AboutMe,
										Rating,
										FacebookID,
										GoogleID,
										CityName,
										CountryName,
										ProfessionName,
										GroupName
									'
									);

			$this->dbHandle->from('user');

			$this->dbHandle->where_in('UserID',$userIds);

			$this->dbHandle->where_in('user.Status',$status);

			$this->dbHandle->join('city', 'city.CityID = user.CityID');

			$this->dbHandle->join('country', 'country.CountryID = user.CountryID');

			$this->dbHandle->join('profession', 'profession.ProfessionID = user.ProfessionID');

			$this->dbHandle->join('user_groups', 'user_groups.GroupID = user.GroupID');

			$userResults	= $this->dbHandle->get()->result_array();
			$listingIds 	= $this->getRelatedListingIds($userIds);
			$tagsFollowedIds= $this->getRelatedTagsFollowedIds($userIds);

	 	foreach ($userResults as $userResult){
		 		$returnArray[$userResult['UserID']]['fullInfo'] = $userResult;
		 		if($listingIds[$userResult['UserID']]){
		 			$returnArray[$userResult['UserID']]['listings'] = $listingIds[$userResult['UserID']];
		 		}
		 		if($tagsFollowedIds[$userResult['UserID']]){
		 			$returnArray[$userResult['UserID']]['tagsFollowed'] = $tagsFollowedIds[$userResult['UserID']];
		 		}
		 	}
		}
		// echo $this->dbHandle->last_query();
		// print_r($userResults);
		// return $userData[0];
		
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		return $returnArray;
	}

	public function getRelatedListingIds($userIds){
		$this->_init('read');

		$this->dbHandle->select('UserID, ListingID');
		$this->dbHandle->from('listing');
		$this->dbHandle->where_in('UserID',$userIds);
		$result_array = $this->dbHandle->get()->result_array();
		// _p($this->dbHandle->last_query());
		$returnArray = array();
		foreach ($result_array as $key => $value) {
			$returnArray[$value['UserID']][] = $value['ListingID'];
		}
		return $returnArray;
	}

	public function getRelatedTagsFollowedIds($userIds){
		$this->_init('read');

		$this->dbHandle->select('UserID, TagID');
		$this->dbHandle->from('user_tag_relation');
		$this->dbHandle->where_in('UserID',$userIds);
		$result_array = $this->dbHandle->get()->result_array();
		// _p($this->dbHandle->last_query());
		$returnArray = array();
		foreach ($result_array as $key => $value) {
			$returnArray[$value['UserID']][] = $value['TagID'];
		}
		return $returnArray;
	}

	public function getUserName($userId,$status='live'){
		$this->_init('read');

		$this->dbHandle->select('Username');
		$this->dbHandle->from('user');
		$this->dbHandle->where('UserID', $userId);
		$this->dbHandle->where('Status',$status);
		$userName = $this->dbHandle->get();
		if($userName->num_rows() > 0){
			$userName = $userName->row();
			return $userName->Username;
		}
		else{
			return false;
		}
		
	}
}
?>
