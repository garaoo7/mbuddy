<?php

class User_builder {
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initUserRepository(){
		self::init();
		$userArray = array('UserBasic','UserFullInfo');
		self::$_ci->load->entities($userArray,'user_module');
		self::$_ci->load->repository('UserRepository','user_module');
		self::$_ci->load->model('user_module/user_model');
		self::$_ci->load->library('user_module/user_lib');
		self::$_ci->load->library('user_module/user_cache');
	}
	
	
	public static function getUserRepository(){
		self::initUserRepository();
		$UserModel = new user_model();
		$UserLib   = new user_lib($UserModel);
		$userCache = new user_cache();
		return new UserRepository($UserModel,$UserLib,$userCache);
	}
}
