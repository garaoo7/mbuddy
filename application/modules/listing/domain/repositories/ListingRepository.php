<?php

class ListingRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $listingModel;
    private $listingLib;
    private $listingCache;
    private $caching;
    public function __construct($listingModel,$listingLib,$listingCache) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($listingModel) && !empty($listingLib)){
			$this->listingModel = $listingModel;
			$this->listingLib   = $listingLib;
			$this->listingCache = $listingCache;
		}
		$this->caching = true;
		$this->CI->load->config('listing/listingConfig');
	}
	
	public function find($listingId = NULL,$sections=array('basic')){
		$ListingObject 	= false;
		if(empty($listingId)){
            return $ListingObject;
		}
		Contract::mustBeNumericValueGreaterThanZero($listingId,'Course ID'); //do not delete this
		
		$this->_validateSections($sections);
		if($this->caching && $dataFromCache = $this->listingCache->getListingObjectFromCache($listingId,$sections)){
			$listingObject = $this->_populateListingObject($dataFromCache,$sections);
			return $listingObject;
		}
		$listingData = $this->listingLib->getSectionWiseListingData($listingId);
		if(!empty($listingData)){
			$listingObject = $this->_populateListingObject($listingData,$sections);
			if($this->caching){
				$this->listingCache->storeListingObject($listingId,$listingData);	
			}	
		}
		return $listingObject;
	}


	public function findMultiple($listingIds = array(),$sections=array('basic')){
		$listingObjects	= array();
		if(empty($listingIds)){
			return $listingObjects;
		}
		Contract::mustBeNonEmptyArrayOfIntegerValues($listingIds,'Course IDs'); //do not delete this
		$this->_validateSections($sections);
		$dataFromCache = array();
		if($this->caching){
			$dataFromCache = $this->listingCache->getMultipleListingObjectsFromCache($listingIds,$sections);
		}
		$listingIdsFromCache 	= array_keys($dataFromCache);
		$listingIdsFromDb 		= array_diff($listingIds,$listingIdsFromCache);
		$listingsDataFromDb 	= $this->listingLib->getSectionWiseMultipleListingsData($listingIdsFromDb,$sections);
		
		if(!empty($dataFromCache)){
			$listingObjectsFromCache  = $this->_populateMultipleListingsObjects($dataFromCache, $listingIdsFromCache,$sections);
		}

		if(!empty($listingsDataFromDb)){
			$listingObjectsFromDB = $this->_populateMultipleListingsObjects($listingsDataFromDb, $listingIdsFromDb,$sections);
			if($this->caching){
				$this->listingCache->storeMultipleListingObject($listingIdsFromDb,$listingsDataFromDb);
			}
		}
		$listingObjects  = (array)$listingObjectsFromCache + (array)$listingObjectsFromDB;
		//echo '<pre>'.print_r($listingsData,TRUE).'</pre>';
        return $listingObjects;
	}
	private function _populateListingObject($listingData,$sections){
		$listingObject = new Listing();
		foreach ($listingData as $section => $sectionData) {
			switch ($section) {
				case 'basic':
					$this->fillListingBasicdata($listingObject,$sectionData);
					break;
				case 'listingLeads':
					$this->fillListingLeads($listingObject,$sectionData);
					break;
				case 'artists':
					$this->fillListingArtists($listingObject,$sectionData);
					break;
				default:
					break;
			}
		}
		// // $listingObjectData 				   	= array();
		// // $listingObjectData['ListingID'] 	= $listingData['listingData']['ListingID'];
		// // $listingObjectData['ListingTitle'] 	= $listingData['listingData']['ListingTitle'];
		// // $listingObjectData['ListingViews'] 	= $listingData['listingData']['ListingViews'];
		// // $listingObjectData['ListingLikes'] 	= $listingData['listingData']['ListingLikes'];
		// // $listingObjectData['ListingDislikes']= $listingData['listingData']['ListingDislikes'];
		// // $listingObjectData['ListingSourceLink']= $listingData['listingData']['ListingSourceLink'];
		// // $listingObjectData['ArtistObject'] 	= $listingData['artistsObject'];
		// // $listingObjectData['UserObject'] 	= $listingData['userObject'];
  // //       $listingObject = new Listing();
  //       $this->fillObjectWithData($listingObject,$listingObjectData);
         //echo '<pre>'.print_r($listingData,TRUE).'</pre>';
        return $listingObject;
	}

	private function _populateMultipleListingsObjects($listingsData,$listingIds,$sections){
		$listingObjects = array();
		foreach ($listingIds as $listingId) {
			if(isset($listingsData[$listingId])){//echo "<br>";
				$listingObjects[$listingId] = $this->_populateListingObject($listingsData[$listingId],$sections);
			}
		}
		return $listingObjects;
	}

	private function _validateSections(&$sections){
		global $listingSections;
		if(in_array('full', $sections)){
			$sections = $listingSections;
		}
		foreach ($sections as $key => $sectionName) {
			if(!in_array($sectionName, $listingSections)){
				unset($sections[$key]);
			}
		}
		if(!in_array('basic', $sections)){
			$sections[] ='basic';
		}
	}
	private function fillListingBasicdata($listingObject,$sectionData){
		$userId = $sectionData['UserID'];
		unset($sectionData['UserID']);
		$this->CI->load->builder('user_module/User_builder');
		$this->UserBuilder = new User_builder();
		$this->UserRepository = $this->UserBuilder->getUserRepository();
		$userObject = $this->UserRepository->find($userId);
		$sectionData['UserObject'] = $userObject;
		$this->fillObjectWithData($listingObject,$sectionData);
	}
	private function fillListingLeads($listingObject,$sectionData){

	}
	private function fillListingArtists($listingObject,$artistIds){
		$this->CI->load->builder('artist/Artist_builder');
		$this->ArtistBuilder = new Artist_builder();
		$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();
		$artistObject = $this->ArtistRepository->findMultiple($artistIds);
		$sectionData['ArtistObject'] = $artistObject;
		$this->fillObjectWithData($listingObject,$sectionData);
	}
}
