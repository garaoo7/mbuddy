<?php
	
class UserModel extends CI_Model{
//change name or explain it in a comment
	public function userExist($value, $type = NULL){
		$this->db->from('user');
		if($type = 'email'){
			$this->db->where('Email', $value);
		}
		else if($type = 'username'){
			$this->db->where('Username', $value);
		}
		else{
			$this->db->where('Email', $value);
			$this->db->or_where('Username', $value);
		}
//select coloumn that are needed
//status check for live and disabled
		$user = $this->db->get();
		$user = $user->row();
		//echo $this->db->last_query();
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

	public function userActived($username){
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



	public function userSignup($userID, $email, $username, $password, $salt){ 
	$sql = "INSERT INTO user (UserID, Email, Username, Password, Salt) VALUES ('$userID', '$email', '$username', '$password', '$salt')";
	return $this->db->query($sql);
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
		$this->db->where('Username', $username);
			$data = array(
	        	'EmailSent' => 'YES'
			);
			return $this->db->update('user', $data);
	}

	public function accountVerified($username){
		$this->db->where('Username', $username);
		$data = array(
        	'Status' => 'live'
		);
		return $this->db->update('user', $data);
	}
}
