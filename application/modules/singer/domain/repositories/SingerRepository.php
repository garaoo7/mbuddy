<?php

class SingerRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $singerModel;
    private $singerLib;
    private $singerCache;
    private $caching;
    public function __construct($singerModel,$singerLib,$singerCache) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($singerModel) && !empty($singerLib)){
			$this->singerModel = $singerModel;
			$this->singerLib   = $singerLib;
			$this->singerCache = $singerCache;
		}
		$this->caching = true;
		$this->CI->load->config('singer/singerConfig');
	}
	
	public function find($singerId = NULL,$sections=array('basic')){
		$singerObject 	= false;
		if(empty($singerId)){
		      return $singerObject;
		}
		Contract::mustBeNumericValueGreaterThanZero($singerId,'Course ID'); //do not delete this
		
		$this->_validateSections($sections);
		if($this->caching && $dataFromCache = $this->singerCache->getSingerObjectFromCache($singerId,$sections)){
			$singerObject = $this->_populateSingerObject($dataFromCache,$sections);
			//_p($singerObject);
			return $singerObject;
		}
		$singerData = $this->singerLib->getSectionWiseSingerData($singerId);
		if(!empty($singerData)){
			$singerObject = $this->_populateSingerObject($singerData,$sections);
			if($this->caching){
				$this->singerCache->storeSingerObject($singerId,$singerData);
			}
		}
		return $singerObject;
	}

		public function findMultiple($singerIds = array(),$sections=array('basic')){
			$singerObjects	= array();
			if(empty($singerIds)){
				return $singerObjects;
			}
			Contract::mustBeNonEmptyArrayOfIntegerValues($singerIds,'Course IDs'); //do not delete this
			$this->_validateSections($sections);
			$dataFromCache = array();
			if($this->caching){
				$dataFromCache = $this->singerCache->getMultipleSingerObjectsFromCache($singerIds,$sections);
			}
			$singerIdsFromCache 	= array_keys($dataFromCache);
			$singerIdsFromDb 		= array_diff($singerIds,$singerIdsFromCache);
			$singersDataFromDb 	= $this->singerLib->getSectionWiseMultipleSingersData($singerIdsFromDb,$sections);

			if(!empty($dataFromCache)){
				$singerObjectsFromCache  = $this->_populateMultipleSingersObjects($dataFromCache, $singerIdsFromCache,$sections);
			}

			if(!empty($singersDataFromDb)){
				$singerObjectsFromDB = $this->_populateMultipleSingersObjects($singersDataFromDb, $singerIdsFromDb,$sections);
				if($this->caching){
					$this->singerCache->storeMultipleSingerObject($singerIdsFromDb,$singersDataFromDb);
				}
			}

			$singerObjects  = (array)$singerObjectsFromCache + (array)$singerObjectsFromDB;

			//echo '<pre>'.print_r($singersData,TRUE).'</pre>';
	        return $singerObjects;
		}

	private function _populateSingerObject($singerData,$sections){
		$singerObject = new Singer();
		foreach ($singerData as $section => $sectionData) {
			if(in_array($section, $sections)){
				switch ($section) {
					case 'basic':
						$this->fillSingerBasicdata($singerObject,$sectionData);
						break;
					case 'listings':
						$this->fillSingerListings($singerObject,$sectionData);
						break;
					default:
						break;
				}
			}
		}
		return $singerObject;
	}

	private function _populateMultipleSingersObjects($singersData,$singerIds,$sections){
		$singerObjects = array();
		foreach ($singerIds as $singerId) {
			if(isset($singersData[$singerId])){
				$singerObjects[$singerId] = $this->_populateSingerObject($singersData[$singerId],$sections);
			}
		}
		return $singerObjects;
	}

	private function _validateSections(&$sections){
		global $singerSections;
		if(in_array('full', $sections)){
			$sections = $singerSections;
		}
		foreach ($sections as $key => $sectionName) {
			if(!in_array($sectionName, $singerSections)){
				unset($sections[$key]);
			}
		}
		if(!in_array('basic', $sections)){
			$sections[] ='basic';
		}
	}

	private function fillSingerBasicdata($singerObject,$sectionData){
		$this->fillObjectWithData($singerObject,$sectionData);
	}

	private function fillSingerListings($singerObject,$listingIds){
		$this->CI->load->builder('listing/Listing_builder');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$listingObject = $this->ListingRepository->findMultiple($listingIds, array('basic'));
		$sectionData['ListingObject'] = $listingObject;
		// _p($sectionData);
		// die;
		$this->fillObjectWithData($singerObject,$sectionData);

	}

}
