<?php

class Artist_builder {
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initArtistRepository(){
		self::init();
		self::$_ci->load->entities(array('Artist'),'artist');
		self::$_ci->load->repository('ArtistRepository','artist');
		self::$_ci->load->model('artist/artist_model');
		self::$_ci->load->library('artist/artist_lib');
	}
	
	
	public static function getArtistRepository(){
		self::initArtistRepository();
		$artistModel = new artist_model();
		$artistLib   = new artist_lib($artistModel);
		return new ArtistRepository($artistModel,$artistLib);
	}
}
