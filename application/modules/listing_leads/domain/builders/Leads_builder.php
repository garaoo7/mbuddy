<?php

class Leads_builder {
	
	static protected $_ci;

	private static function init(){
		self::$_ci = & get_instance();
	}
	
	
	public static function initLeadsRepository(){
		self::init();
		$leadsArray = array('Singer','Writer','Composer','Producer');
		self::$_ci->load->entities($leadsArray,'listing_leads');
		self::$_ci->load->repository('LeadsRepository','listing_leads');
		self::$_ci->load->model('listing_leads/leads_model');
		self::$_ci->load->library('listing_leads/leads_lib');
		self::$_ci->load->library('listing_leads/leads_cache');
	}
	
	
	public static function getLeadsRepository(){
		self::initLeadsRepository();
		$leadsModel = new leads_model();
		$leadsLib   = new leads_lib($leadsModel);
		$leadsCache = new leads_cache();
		return new LeadsRepository($leadsModel,$leadsLib,$leadsCache);
	}
}
