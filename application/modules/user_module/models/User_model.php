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
	public function getUserData($userId,$status = array('live'),$sections=array('basic')){
//used for domain
		$this->_init('read');

		if(in_array('basic', $sections)){
			$this->dbHandle->select('Username');

			$this->dbHandle->from('user');

			$this->dbHandle->where_in('UserID',$userId);

			$this->dbHandle->where_in('Status',$status);

			$userData = $this->dbHandle->get()->row_array();
		}
		//echo $this->dbHandle->last_query();
		//print_r($userData);
		return $userData;
		
		//creating temp return data, data should be fetched according to above logic
		// $userData['Username'] = '1000';
		// $userData['FirstName'] = 'Papa';
		// $userData['LastName'] = '1000';
		// return $userData;
	}

	public function getMultipleUsersData($userIds = array(),$status = array('live'),$sections=array('basic')){
//used for domain

		$this->_init('read');
		$usersData = array();

		$this->dbHandle->select('UserID,Username,FirstName,LastName');

			$this->dbHandle->from('user');

			$this->dbHandle->where_in('UserID',$userIds);

			$this->dbHandle->where_in('Status',$status);

			$userResults = $this->dbHandle->get()->result_array();

			foreach ($userResults as $userResult){
				$usersData[$userResult['UserID']]['Username'] 	= $userResult['Username'];
				$usersData[$userResult['UserID']]['FirstName'] 	= $userResult['FirstName'];
				$usersData[$userResult['UserID']]['LastName'] 	= $userResult['LastName'];
			}
		// echo $this->dbHandle->last_query();
		// print_r($userResults);
		// return $userData[0];
		
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		return $usersData;
	}
}
?>
