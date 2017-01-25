<?php

class User_builder {
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initUserRepository(){
		self::init();
		self::$_ci->load->entities(array('User'),'user_module');
		self::$_ci->load->repository('UserRepository','user_module');
		self::$_ci->load->model('user_module/user_model');
		self::$_ci->load->library('user_module/user_lib');
	}
	
	
	public static function getUserRepository(){
		self::initUserRepository();
		$UserModel = new user_model();
		$UserLib   = new user_lib($UserModel);
		return new UserRepository($UserModel,$UserLib);
	}
}
