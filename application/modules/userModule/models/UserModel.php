<?php
	
class UserModel extends CI_Model{

	public function userVerification($username, $password){

		$sql1 = "SELECT Salt FROM user WHERE Username = ? ";
		$query1 = $this->db->query($sql1, array($username));
		$salt = $query1->row();

		if(isset($salt)){

			$salt = $salt->Salt;
			$password = md5($password.$salt);
			$sql2 = "SELECT * FROM `user` WHERE Username = ? AND Password = ? ";
			$query2 = $this->db->query($sql2, array($username, $password));
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
		$sql1 = "SELECT * FROM user WHERE Email = ? OR Username = ? ";
		$query1 = $this->db->query($sql1, array($_POST["emailAddress"], $_POST["username"]));
		$query1 = $query1->row();

		if(isset($query1)){

			return false;
		}
//inserting new user credentials into database
		$this->db->trans_start();
		$sql2 = "INSERT INTO user (UserID, FirstName, LastName, Email, Username, Password, Gender, Salt) Value (?, ?, ?, ?, ?, ?, ?, ?) ";
		$query2 = $this->db->query($sql2, array('2', $_POST["firstname"], $_POST["lastname"], $_POST["emailAddress"], $_POST["username"], $password, 'Male', $salt));
		
		$this->db->trans_complete();

		if(isset($query2)){
/*			$to = $_POST["emailAddress"];
			$subject = "Account Vwrification";
			$message = '
			Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$_POST["username"].'
------------------------
			Please click this link to activate your account:
			';
			$headers = 'From:noreply@mbuddy.com';
			mail($to, $subject, $message, $headers);
*/
			return true;
		}
	}



}


?>