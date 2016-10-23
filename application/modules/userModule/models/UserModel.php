<?php
	
class UserModel extends CI_Model{

	public function userVerification($username, $password){

		$query1 = $this->db->query("SELECT Salt FROM user WHERE Username = '{$username}' ");
		$salt = $query1->row();

		if(isset($salt)){

			$salt = $salt->Salt;
			$password = md5($password.$salt);
			$query2 = $this->db->query("SELECT * FROM `user` WHERE Username = '{$username}' AND Password = '{$password}' ");
			$row = $query2->row();

			if(isset($row)){

				return true;
			}
		}

		else{

			return false;
		}
	}

	public function userSignup($password, $salt){
//verifying existing user
		$query1 = $this->db->query("SELECT * FROM user WHERE Email = '{$_POST["emailAddress"]}' OR Username = '{$_POST["username"]}' ");
		$query1 = $query1->row();

		if(isset($query1)){

			return false;
		}
//inserting new user credentials into database
		$this->db->trans_start();

		$query2 = $this->db->query("INSERT INTO user (UserID, FirstName, LastName, Email, Username, Password, Gender, Salt) Value ('2', '{$_POST["firstname"]}', '{$_POST["lastname"]}', '{$_POST["emailAddress"]}', '{$_POST["username"]}', '{$password}', 'Male', '{$salt}') ");
		
		$this->db->trans_complete();

		if(isset($query2)){

			return true;
		}
	}



}


?>