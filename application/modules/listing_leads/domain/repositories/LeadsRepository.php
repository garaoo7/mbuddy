<?php

class LeadsRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $leadsModel;
    private $leadsLib;
    private $leadsCache;
    private $caching;
    public function __construct($leadsModel,$leadsLib,$leadsCache) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($leadsModel) && !empty($leadsLib)){
			$this->leadsModel = $leadsModel;
			$this->leadsLib   = $leadsLib;
			$this->leadsCache = $leadsCache;
		}
		$this->caching = false;
		$this->CI->load->config('listing_leads/leadsConfig');
	}
	
	public function find($lead = NULL,$leadId = NULL,$sections=array('basic')){
		// foreach ($listingLead as $key => $value) {
		// 	$lead = $key;
		// 	$leadId = $value;
		// }
		$leadObject 	= false;
		if(empty($leadId)){
		      return $leadObject;
		}
		Contract::mustBeNumericValueGreaterThanZero($leadId,'Course ID'); //do not delete this
		
		$this->_validateSections($sections);
		if($this->caching && $dataFromCache = $this->leadsCache->getLeadObjectFromCache($lead,$leadId,$sections)){
			$leadObject = $this->_populateLeadObject($lead,$dataFromCache,$sections);
			//_p($leadObject);
			return $leadObject;
		}
		$leadData = $this->leadsLib->getSectionWiseLeadData($lead,$leadId);
		if(!empty($leadData)){
			$leadObject = $this->_populateLeadObject($lead,$leadData,$sections);
			_p($leadObject);
			die;
			if($this->caching){
				$this->leadsCache->storeLeadObject($lead,$leadId,$leadData);
			}
		}
		return $leadObject;
	}

		public function findMultiple($lead,$leadIds = array(),$sections=array('basic')){
			$leadObjects	= array();
			if(empty($leadIds)){
				return $leadObjects;
			}
			Contract::mustBeNonEmptyArrayOfIntegerValues($leadIds,'Course IDs'); //do not delete this
			$this->_validateSections($sections);
			$dataFromCache = array();
			if($this->caching){
				$dataFromCache = $this->leadsCache->getMultipleLeadObjectsFromCache($lead,$leadIds,$sections);
			}
			$leadIdsFromCache 	= array_keys($dataFromCache);
			$leadIdsFromDb 		= array_diff($leadIds,$leadIdsFromCache);
			$leadsDataFromDb 	= $this->leadsLib->getSectionWiseMultipleLeadsData($lead,$leadIdsFromDb,$sections);

			if(!empty($dataFromCache)){
				$leadObjectsFromCache  = $this->_populateMultipleLeadsObjects($lead,$dataFromCache, $leadIdsFromCache,$sections);
			}

			if(!empty($leadsDataFromDb)){
				$leadObjectsFromDB = $this->_populateMultipleLeadsObjects($lead,$leadsDataFromDb, $leadIdsFromDb,$sections);
				if($this->caching){
					$this->leadCache->storeMultipleLeadObject($lead,$leadIdsFromDb,$leadsDataFromDb);
				}
			}

			$leadObjects  = (array)$leadObjectsFromCache + (array)$leadObjectsFromDB;

			//echo '<pre>'.print_r($leadsData,TRUE).'</pre>';
	        return $leadObjects;
		}

	private function _populateLeadObject($lead,$leadData,$sections){
		switch ($lead){
			case 'singer':
				$leadObject = new Singer();
				break;
			case 'writer':
				$leadObject = new Writer();
				break;
			case 'composer':
				$leadObject = new Composer();
				break;
			case 'producer':
				$leadObject = new Producer();
				break;
			default:
				break;
		}
		foreach ($leadData as $section => $sectionData) {
			if(in_array($section, $sections)){
				switch ($section) {
					case 'basic':
						$this->fillLeadBasicdata($leadObject,$sectionData);
						break;
					case 'listings':
						$this->fillLeadListings($leadObject,$sectionData);
						break;
					default:
						break;
				}
			}
		}
		return $leadObject;
	}

	private function _populateMultipleLeadsObjects($lead,$leadsData,$leadIds,$sections){
		$leadObjects = array();
		foreach ($leadIds as $leadId) {
			if(isset($leadsData[$leadId])){
				$leadObjects[$leadId] = $this->_populateLeadObject($lead,$leadsData[$leadId],$sections);
			}
		}
		return $leadObjects;
	}

	private function _validateSections(&$sections){
		global $leadSections;
		if(in_array('full', $sections)){
			$sections = $leadSections;
		}
		foreach ($sections as $key => $sectionName) {
			if(!in_array($sectionName, $leadSections)){
				unset($sections[$key]);
			}
		}
		if(!in_array('basic', $sections)){
			$sections[] ='basic';
		}
	}

	private function fillLeadBasicdata($leadObject,$sectionData){
		$this->fillObjectWithData($leadObject,$sectionData);
	}

	private function fillLeadListings($leadObject,$listingIds){
		$this->CI->load->builder('listing/Listing_builder');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$listingObject = $this->ListingRepository->findMultiple($listingIds, array('basic'));
		$sectionData['ListingObject'] = $listingObject;
		// _p($sectionData);
		// die;
		$this->fillObjectWithData($leadObject,$sectionData);

	}

}
