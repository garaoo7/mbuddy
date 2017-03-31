<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_verification_email extends MX_Controller {

    public function send_verification_mail($email, $username, $salt){
  //   	$CI =& get_instance();
		// $config = array(
		// 	'protocol'  => 'smtp',
		// 	'mailtype'  => 'html',
		// 	'smtp_host' => 'ssl://smtp.gmail.com',
		// 	'smtp_port' =>  '465',
		// 	'smtp_user' => 'shivamrocksgarg@gmail.com',
		// 	'smtp_pass' =>'faker123#'
		// 	);
	

		// $CI->load->library('email', $config);
		// $CI->email->set_newline("\r\n");
		// $CI->email->from('shivamrocksgarg@gmail.com', 'noname');
	 //    $CI->email->to($email); 
	 //    $CI->email->subject('Email Test');
	 //    $CI->email->message('Testing the email class.<br><br>http://www.localhost/mbuddy/index.php/userModule/home/verifyEmail/'.$username.'/'.md5($salt));

	 //    if($CI->email->send()){
	 //   		return $CI->userModel->emailSent($username);
		// }
    	return true;
    	return false;

	}
}
?>