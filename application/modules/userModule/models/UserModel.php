<?php
	
class UserModel extends MY_Model{
//change name or explain it in a comment
	private $dbHandle;

	private function _init($A = 'read'){
		if($A=='read'){
			$this->dbHandle = $this->getReadHandle();
		}
		else if($A=='write'){
			$this->dbHandle = $this->getWriteHandle();
		}
	}

	public function userExist($value, $type = NULL){
		$this->_init('read');
		
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
//select coloumn that are needed
//status check for live and disabled
		$user = $this->dbHandle->get();
		$user = $user->row();
		//echo $this->dbHandle->last_query();
		return $user;		
	}


//**comments
	public function userLogin($username, $password){
		$user = $this->userExist($username, 'username');

		if(isset($user)){
			$salt = $user->Salt;
			$password = $this->hashPassword($password, $salt);
			if($password == $user->Password){
				return true;
			}
		}
		else{
			return false;
		}
	}

	public function userActivated($username){
			$user = $this->userExist($username, 'username');

		if(isset($user)){
			$status = $user->Status;
			if($status == 'live'){
				return true;
			}
		}
		else{
			return false;
		}
	}



	public function userSignup($data){ 
		$this->_init('write');
		return $this->dbHandle->insert('user', $data);
	}





	public function hashPassword($password, $salt){
		$password = utf8_encode($password);
		$salt     = utf8_encode($salt);
		$password = md5($password);
		$password = md5($password.$salt);
		$password = base64_encode($password);
		return $password;
	}

	public function emailSent($username){
		$this->_init('write');
		$this->dbHandle->where('Username', $username);
			$data = array(
	        	'EmailSent' => 'YES'
			);
			return $this->dbHandle->update('user', $data);
	}

	public function accountVerified($username){
		$this->_init('write');
		$this->dbHandle->where('Username', $username);
		$data = array(
        	'Status' => 'live'
		);
		return $this->dbHandle->update('user', $data);
	}
}
