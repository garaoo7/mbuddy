<?php

class Listing_assembly_builder{
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initListingRepository(){
		self::init();
		self::$_ci->load->entities(array('ListingAssembly'),'listing');
		self::$_ci->load->repository('ListingAssemblyRepository','listing');
		self::$_ci->load->model('listing/listing_model');
		self::$_ci->load->library('listing/listing_assembly_lib');
	}
	
	
	public static function getListingAssemblyRepository(){
		self::initListingRepository();
		$ListingModel = new listing_model();
		$ListingLib   = new listing_assembly_lib($ListingModel);
		return new ListingAssemblyRepository($ListingModel, $ListingLib);
	
	}
}
