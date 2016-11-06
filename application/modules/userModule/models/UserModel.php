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



	public function userSignup($data){

		return $this->db->insert('user', $data);
	}

//use below query for insertion
//insert into user (userid,email) values(select max userid from user)+1;
	//issues - trans_incompl**


//	INSERT INTO 
//customers( customer_id, firstname, surname )
//SELECT MAX( customer_id ) + 1, 'jim', 'sock' FROM customers;

	public function lastInsertUserId(){
		$query = "SELECT * FROM user ORDER BY UserID DESC LIMIT 1";
		$user = $this->db->query($query);
		$user = $user->row();
		$UserId = $user->UserID;
		return $UserId;
		}




	public function hashPassword($password, $salt){
		$password = utf8_encode($password);
		$salt     = utf8_encode($salt);
		$password = md5($password);
		$password = md5($password.$salt);
		$password = base64_encode($password);
		return $password;
	}

//this should be in a diff module, in its library
	public function sendVerificationMail($email, $username, $salt){
		$config = array(
			'protocol'  => 'smtp',
			'mailtype'  => 'html',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' =>  465,
			'smtp_user' => 'shivamrocksgarg@gmail.com',
			'smtp_pass' =>'faker123#'
			);
	

	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");

	$this->email->from('shivamrocksgarg@gmail.com', 'noname');
    $this->email->to($email); 

    $this->email->subject('Email Test');
//**don't use post for emailAddress
//**send username and salt (ref. forgot password controller in ansquick)
    $this->email->message('Testing the email class.<br><br>http://www.localhost/mbuddy/index.php/userModule/home/verifyEmail/'.$username.'/'.md5($salt));  

    $this->email->send();

   	echo $this->email->print_debugger();

	}
//mbuddy.com/user/signup/varifiaction/gara/12312983120983120938120983jkhgjfgjfjghc
	public function accountVerified($username){
		$this->db->where('Username', $username);
		$data = array(
        	'Status' => 'live'
		);
		return $this->db->update('user', $data);
	}
}
