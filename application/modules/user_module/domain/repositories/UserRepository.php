<?php

class UserRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $userModel;
    private $userLib;
    private $userCache;
    private $caching;
    public function __construct($userModel,$userLib,$userCache) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($userModel) && !empty($userLib)){
			$this->userModel = $userModel;
			$this->userLib   = $userLib;
			$this->userCache = $userCache;
		}
		$this->caching = true;
		$this->CI->load->config('user_module/userConfig');
	}
	
	public function find($userId = NULL,$sections=array('basic')){
		$userObject 	= false;
		if(empty($userId)){
            return $userObject;
		}
		Contract::mustBeNumericValueGreaterThanZero($userId,'Course ID'); //do not delete this
		
		$this->_validateSections($sections);
		if($this->caching && $dataFromCache = $this->userCache->getUserObjectFromCache($userId,$sections)){
			$userObject = $this->_populateUserObject($dataFromCache,$sections);
			//_p($userObject);
			return $userObject;
		}
		$userData = $this->userLib->getSectionWiseUserData($userId,$sections);

		if(!empty($userData)){
			$userObject = $this->_populateUserObject($userData,$sections);
			if($this->caching){
				$this->userCache->storeUserObject($userId,$userData);	
			}	
		}
		// _p($userData);
		// die;
		return $userObject;
	}


	public function findMultiple($userIds = array(),$sections=array('basic')){
		$userObjects	= array();
		if(empty($userIds)){
			return $userObjects;
		}
		Contract::mustBeNonEmptyArrayOfIntegerValues($userIds,'Course IDs'); //do not delete this
		$this->_validateSections($sections);
		$dataFromCache = array();
		if($this->caching){
			$dataFromCache = $this->userCache->getMultipleUserObjectsFromCache($userIds,$sections);
		}
		$userIdsFromCache 	= array_keys($dataFromCache);
		$userIdsFromDb 		= array_diff($userIds,$userIdsFromCache);
		$usersDataFromDb 	= $this->userLib->getSectionWiseMultipleUsersData($userIdsFromDb,$sections);

		if(!empty($dataFromCache)){
			$userObjectsFromCache  = $this->_populateMultipleUsersObjects($dataFromCache, $userIdsFromCache,$sections);
		}

		if(!empty($usersDataFromDb)){
			$userObjectsFromDB = $this->_populateMultipleUsersObjects($usersDataFromDb, $userIdsFromDb,$sections);
			if($this->caching){
				$this->userCache->storeMultipleUserObject($userIdsFromDb,$usersDataFromDb);
			}
		}

		$userObjects  = (array)$userObjectsFromCache + (array)$userObjectsFromDB;

		//echo '<pre>'.print_r($usersData,TRUE).'</pre>';
        return $userObjects;
	}
	private function _populateUserObject($userData,$sections){
		//creating too many unwanted variables if basic is required, solution might be to use 2 entites
		if(in_array('basic', $sections)){
			$userObject = new UserBasic();
		}
		else if(in_array('fullInfo', $sections)){
			$userObject = new UserFullInfo();
		}
		foreach ($userData as $section => $sectionData) {
			if(in_array($section, $sections)){
				switch ($section) {
					case 'basic':
						$this->fillUserData($userObject,$sectionData);
						break;
					case 'fullInfo':
						$this->fillUserData($userObject,$sectionData);
						break;
					case 'listings':
						$this->fillUserListings($userObject,$sectionData);
						break;
					case 'tags':
						//$this->fillUserTags($userObject,$sectionData);
						break;
					default:
						break;
				}
			}
		}
         //echo '<pre>'.print_r($userData,TRUE).'</pre>';
        return $userObject;
	}

	private function _populateMultipleUsersObjects($usersData,$userIds,$sections){
		$userObjects = array();
		foreach ($userIds as $userId) {
			if(isset($usersData[$userId])){
				$userObjects[$userId] = $this->_populateUserObject($usersData[$userId],$sections);
			}
		}
		return $userObjects;
	}

	private function _validateSections(&$sections){
		global $userSections;
		if(in_array('full', $sections)){
			$sections = $userSections;
			$key = array_search('basic', $sections);
			unset($sections[$key]);
		}
		foreach ($sections as $key => $sectionName) {
			if(!in_array($sectionName, $userSections)){
				unset($sections[$key]);
			}
		}
		if((!in_array('basic', $sections)) && (!in_array('fullInfo', $sections))){
			$sections[] ='basic';
		}

	}

	private function fillUserData($listingObject,$sectionData){
		$this->fillObjectWithData($listingObject,$sectionData);
	}

	private function fillUserListings($userObject,$listingIds){
		$this->CI->load->builder('listing/Listing_builder');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$listingObject = $this->ListingRepository->findMultiple($listingIds, array('basic'));
		$sectionData['ListingObject'] = $listingObject;
		// _p($sectionData);
		// die;
		$this->fillObjectWithData($userObject,$sectionData);
	}

	// private function fillUserTags($userObject,$tagIds){
	// 	$this->CI->load->builder('tag/tag_builder');
	// 	$this->TagBuilder = new Tag_builder();
	// 	$this->TagRepository = $this->TagBuilder->getTagRepository();
	// 	$tagObject = $this->TagRepository->findMultiple($tagIds, array('basic'));
	// 	$sectionData['TagObject'] = $tagObject;
	// 	// _p($sectionData);
	// 	// die;
	// 	$this->fillObjectWithData($userObject,$sectionData);
	// }
}
