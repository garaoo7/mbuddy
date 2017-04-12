<?php

class Tag_builder{
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initTagRepository(){
		self::init();
		self::$_ci->load->entities(array('Tag'),'tag');
		self::$_ci->load->repository('TagRepository','tag');
		self::$_ci->load->model('tag/tag_model');
		self::$_ci->load->library('tag/tag_lib');
		self::$_ci->load->library('tag/tag_cache');
	}
	
	
	public static function getTagRepository(){
		self::initTagRepository();
		$tagModel = new tag_model();
		$tagLib   = new tag_lib($tagModel);
		$tagCache = new tag_cache();
		return new TagRepository($tagModel,$tagLib,$tagCache);
	
	}
}
