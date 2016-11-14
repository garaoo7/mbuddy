<?php

class ListingBuilder {
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initListingRepository(){
		self::init();
		self::$_ci->load->entities(array('Listing'),'Listing');
		self::$_ci->load->repository('ListingRepository','Listing');
		self::$_ci->load->model('ListingModel','Listing');
		self::$_ci->load->library('ListingLib','Listing');
	}
	
	
	public static function getListingRepository(){
		self::initListingRepository();
		$ListingModel = new ListingModel();
		$ListingLib   = new ListingLib($ListingModel);
		return new ListingRepository($ListingModel,$ListingLib);
	}
}
