<?php

class Singer_builder {
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initSingerRepository(){
		self::init();
		self::$_ci->load->entities(array('Singer'),'singer');
		self::$_ci->load->repository('SingerRepository','singer');
		self::$_ci->load->model('singer/singer_model');
		self::$_ci->load->library('singer/singer_lib');
	}
	
	
	public static function getSingerRepository(){
		self::initSingerRepository();
		$singerModel = new singer_model();
		$singerLib   = new singer_lib($singerModel);
		return new SingerRepository($singerModel,$singerLib);
	}
}
