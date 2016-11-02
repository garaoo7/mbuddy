<?php
	
class UserModel extends CI_Model{

	public function userExist($username){
		$this->db->from('user');
		if(strlen(strstr($username, "@")) > 0){
			$this->db->where('Email', $username);
		}
		else{
			$this->db->where('Username', $username);
		}
		$user = $this->db->get();
		$user = $user->row();
		return $user;		
	}



	public function userLogin($username, $password){
		$user = $this->userExist($username);

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
			$user = $this->userExist($username);

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



	public function hashPassword($password, $salt){
		$password = utf8_encode($password);
		$salt =  utf8_encode($salt);
		$password = md5($password);
		$password = md5($password.$salt);
		$password = base64_encode($password);
		return $password;
	}


	public function sendVerificationMail(){
		$config = array(
			'protocol' => 'smtp',
			'mailtype' => 'html',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'shivamrocksgarg@gmail.com',
			'smtp_pass' =>'faker123#'
			);
	

	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");

	$this->email->from('shivamrocksgarg@gmail.com', 'noname');
    $this->email->to($_POST["emailAddress"]); 

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.<br><br>http://www.localhost/mbuddy/index.php/userModule/home/verifyEmail/'.md5($_POST["emailAddress"]));  

    $this->email->send();

   	echo $this->email->print_debugger();

	}

	public function accountVerified($key){
		$this->db->where('md5(Email)', $key);
		$data = array(
        	'Status' => 'live'
		);
		return $this->db->update('user', $data);
	}
}
