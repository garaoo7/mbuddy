<?php

class Listing_lib{

	private $listingModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct($listingModel){
		if(!empty($listingModel)){
			$this->listingModel = $listingModel;
		}
		$this->ci =& get_instance();
	}

	public function getListingData($listingId, $status = array('live'),$sections=array('basic')){
		$listingData = false;
		if(empty($listingId)){
			return $listingData;
		} 

		if(in_array('artist', $sections) || in_array('full', $sections)){
			$artistIds = $this->getRelatedIds($listingId, 'artist');
			$this->ci->load->builder('artist/Artist_builder');
			$this->ArtistBuilder = new Artist_builder();
			$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();
			$artistObject = $this->ArtistRepository->findMultiple($artistIds, $status, array('basic'));
			$listingData['artistsObject'] = $artistObject;
			//echo '<pre>'.print_r($artistIds,TRUE).'</pre>';
		}

		if(in_array('basic', $sections) || in_array('full', $sections)){

			$listingData['listingData'] = $this->listingModel->getListingData($listingId,$status,$sections);
			//get userID from listing table and use it below

			$userId = $this->getRelatedIds($listingId, 'user');
			$this->ci->load->builder('user_module/User_builder');
			$this->UserBuilder = new User_builder();
			$this->UserRepository = $this->UserBuilder->getUserRepository();
			$userObject = $this->UserRepository->find($userId, $status, array('basic'));
			$listingData['userObject'] = $userObject;
		}
		// echo '<pre>'.print_r($userID,TRUE).'</pre>';
		//echo '<pre>'.print_r($listingsObject,TRUE).'</pre>';
		return $listingData;
	}

	public function getMultipleListingsData($listingIds, $status = array('live'),$sections){
		$listingsData = false;
		if(empty($listingIds)){ //check for array also
			return $listingsData;
		}

		if(in_array('basic', $sections)){

			$listingsTempData = $this->listingModel->getMultipleListingsData($listingIds,$status,$sections);
			//get userID from listing table and use it below
			$userIds = $this->getRelatedIds($listingIds, 'user');
			$this->ci->load->builder('user_module/User_builder');
			$this->UserBuilder = new User_builder();
			$this->UserRepository = $this->UserBuilder->getUserRepository();
			$userObjects = $this->UserRepository->findMultiple($userIds, $status, array('basic'));
		}
		foreach ($listingIds as $listingId) {
			$listingsData[$listingId]['listingData'] = $listingsTempData[$listingId];
			$listingsData[$listingId]['userObject'] = $userObjects[$listingsTempData[$listingId]['UserID']];
		}
		//echo "<br><br><br>";
		//echo '<pre>'.print_r($listingsData,TRUE).'</pre>';
		return $listingsData;
	}

	public function getRelatedIds($listingIds, $key){
		return $this->listingModel->getRelatedIds($listingIds, $key);
	}
	
}
?>
