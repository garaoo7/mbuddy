<?php

class Listing_builder{
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initListingRepository(){
		self::init();
		self::$_ci->load->entities(array('Listing'),'listing');
		self::$_ci->load->repository('ListingRepository','listing');
		self::$_ci->load->model('listing/listing_model');
		self::$_ci->load->library('listing/listing_lib');
		self::$_ci->load->library('listing/listing_cache');
	}
	
	
	public static function getListingRepository(){
		self::initListingRepository();
		$ListingModel = new listing_model();
		$ListingLib   = new listing_lib($ListingModel);
		$ListingCache = new listing_cache();
		return new ListingRepository($ListingModel,$ListingLib,$ListingCache);
	
	}
}
