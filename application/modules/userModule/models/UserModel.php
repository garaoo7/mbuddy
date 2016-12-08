<?php
	
class UserModel extends MY_Model{

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

	public function userExist($value, $type = NULL/*, $statusCheck = NULL*/){
//check if a user entry exists in the database and returns the row entry if he exists
		$this->_init('read');
		$this->dbHandle->select('UserID, Username, Password, Email, Status, Salt');
		$this->dbHandle->from('user');
		if($type == 'email'){
			//if($statusCheck = true){
			// 	$this->dbHandle->where('Email', $value);
			// 	$this->dbHandle->where_not_in('Status', 'deleted');
			// }
			// else{
				$this->dbHandle->where('Email', $value);
			//}
		}
		else if($type == 'username'){
			// if($statusCheck = true){
				
			// 	$this->dbHandle->where_not_in('Status', 'deleted');
			// }
			// else{
				$this->dbHandle->where('Username', $value);
			//}
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
				if($status == 'live'){
					$salt = $user->Salt;
					$password = $this->hashPassword($password, $salt);
					if($password == $user->Password){
						return 'true';
					}
					else{
						return 'false';
					}
				}
				else{
					return 'notVerified';
				}
			}
		}
		else{
//not existing account also returns false (same as incorrect password), so that no one could take advantage of knowing which username exists in our database and which does not.
			return 'false';
		}
	}

//**deleted userActivated

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

	public function cronjobVerificationEmail(){
//updates the entry of EmailSent to YES when verification mail is successfully sent
		$this->_init('write');
		$this->dbHandle->select('Username, Email, Salt');
		$this->dbHandle->from('user');
		$this->dbHandle->where('EmailSent', 'NO');
		$user = $this->dbHandle->get();
		$user = $user->row();
		$username = $user->Username;
		$email = $user->Email;
		$salt = $user->Salt;
		$this->load->module('emailModule/sendverificationemail');
		if($this->sendverificationemail->sendVerificationMail($email, $username, $salt)){
			$this->emailSent($username);
		}
		return;
	}
}
?>
