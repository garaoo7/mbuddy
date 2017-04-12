<?php

class TagRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $tagModel;
    private $tagLib;
    private $tagCache;
    private $caching;
    public function __construct($tagModel,$tagLib,$tagCache) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($tagModel) && !empty($tagLib)){
			$this->tagModel = $tagModel;
			$this->tagLib   = $tagLib;
			$this->tagCache = $tagCache;
		}
		$this->caching = true;
		$this->CI->load->config('tag/tagConfig');
	}
	
	public function find($tagId = NULL,$sections=array('basic')){
		$tagObject 	= false;
		if(empty($tagId)){
            return $tagObject;
		}
		Contract::mustBeNumericValueGreaterThanZero($tagId,'Course ID'); //do not delete this
		
		$this->_validateSections($sections);
		if($this->caching && $dataFromCache = $this->tagCache->getTagObjectFromCache($tagId,$sections)){
			$tagObject = $this->_populateTagObject($dataFromCache,$sections);
			//_p($tagObject);
			return $tagObject;
		}
		$tagData = $this->tagLib->getSectionWiseTagData($tagId);

		if(!empty($tagData)){
			$tagObject = $this->_populateTagObject($tagData,$sections);
			if($this->caching){
				$this->tagCache->storeTagObject($tagId,$tagData);	
			}	
		}
		return $tagObject;
	}


	public function findMultiple($tagIds = array(),$sections=array('basic')){
		$tagObjects	= array();
		if(empty($tagIds)){
			return $tagObjects;
		}
		Contract::mustBeNonEmptyArrayOfIntegerValues($tagIds,'Course IDs'); //do not delete this
		$this->_validateSections($sections);
		$dataFromCache = array();
		if($this->caching){
			$dataFromCache = $this->tagCache->getMultipleTagObjectsFromCache($tagIds,$sections);
		}
		$tagIdsFromCache 	= array_keys($dataFromCache);
		$tagIdsFromDb 		= array_diff($tagIds,$tagIdsFromCache);
		$tagsDataFromDb 	= $this->tagLib->getSectionWiseMultipleTagsData($tagIdsFromDb);

		if(!empty($dataFromCache)){
			$tagObjectsFromCache  = $this->_populateMultipleTagsObjects($dataFromCache, $tagIdsFromCache,$sections);
		}

		if(!empty($tagsDataFromDb)){
			$tagObjectsFromDB = $this->_populateMultipleTagsObjects($tagsDataFromDb, $tagIdsFromDb,$sections);
			if($this->caching){
				$this->tagCache->storeMultipleTagObject($tagIdsFromDb,$tagsDataFromDb);
			}
		}

		$tagObjects  = (array)$tagObjectsFromCache + (array)$tagObjectsFromDB;

		//echo '<pre>'.print_r($tagsData,TRUE).'</pre>';
        return $tagObjects;
	}
	private function _populateTagObject($tagData,$sections){

		$tagObject = new Tag();
		foreach ($tagData as $section => $sectionData) {
			if(in_array($section, $sections)){
				switch ($section) {
					case 'basic':
						$this->fillTagBasicdata($tagObject,$sectionData);
						break;
					case 'listings':
						$this->fillTagListings($tagObject,$sectionData);
						break;
					default:
						break;
				}
			}
		}
         //echo '<pre>'.print_r($tagData,TRUE).'</pre>';
        return $tagObject;
	}

	private function _populateMultipleTagsObjects($tagsData,$tagIds,$sections){
		$tagObjects = array();
		foreach ($tagIds as $tagId) {
			if(isset($tagsData[$tagId])){//echo "<br>";
				$tagObjects[$tagId] = $this->_populateTagObject($tagsData[$tagId],$sections);
			}
		}
		return $tagObjects;
	}

	private function _validateSections(&$sections){
		global $tagSections;
		if(in_array('full', $sections)){
			$sections = $tagSections;
		}
		foreach ($sections as $key => $sectionName) {
			if(!in_array($sectionName, $tagSections)){
				unset($sections[$key]);
			}
		}
		if(!in_array('basic', $sections)){
			$sections[] ='basic';
		}
	}
	private function fillTagBasicdata($tagObject,$sectionData){
		$userId = $sectionData['TagCreatedBy'];
		// unset($sectionData['TagCreatedBy']);
		$this->CI->load->builder('user_module/User_builder');
		$this->UserBuilder = new User_builder();
		$this->UserRepository = $this->UserBuilder->getUserRepository();
		$userObject = $this->UserRepository->find($userId);
		$sectionData['UserObject'] = $userObject;
		$this->fillObjectWithData($tagObject,$sectionData);
	}
	
	private function fillTagListings($tagObject,$listingIds){
		$this->CI->load->builder('listing/Listing_builder');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$listingObject = $this->ListingRepository->findMultiple($listingIds, array('basic'));
		$sectionData['ListingObject'] = $listingObject;
		$this->fillObjectWithData($tagObject,$sectionData);
	}

}
