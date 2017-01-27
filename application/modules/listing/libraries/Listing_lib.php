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



		// if(in_array('basic', $sections) || in_array('full', $sections)){

		// 	$this->ci->load->builder('listing/Listing_builder');
		// 	$this->ListingBuilder = new Listing_builder();
		// 	$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		// 	$listingObject = $this->ListingRepository->findMultiple($listingIds, 'live', 'basic');
		// 	// echo '<pre>'.print_r($listingsObject,TRUE).'</pre>';
		// }

		if(in_array('artist', $sections) || in_array('full', $sections)){

			$artistIds = $this->getIds($listingId, 'artist');
			$this->ci->load->builder('artist/Artist_builder');
			$this->ArtistBuilder = new Artist_builder();
			$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();
			$artistObject = $this->ArtistRepository->findMultiple($artistIds, array('live'), array('basic'));
			$listingsData['artistsObject'] = $artistObject;
		}

		if(in_array('user', $sections) || in_array('full', $sections)){

			$userId = $this->getIds($listingId, 'user');
			$this->ci->load->builder('user_module/User_builder');
			$this->UserBuilder = new User_builder();
			$this->UserRepository = $this->UserBuilder->getUserRepository();
			$userObject = $this->UserRepository->find($userId, array('live'), array('basic'));
			$listingsData['userObject'] = $userObject;
		}

		// if(in_array('leads', $sections) || in_array('full', $sections)){


		//  	$this->ci->load->builder('singer/Singer_builder');
		//  	$this->SingerBuilder = new Singer_builder();
		//  	$this->SingerRepository = $this->SingerBuilder->getSingerRepository();
		//  	$recentSingers = array('3', '4', '5');
		//  	$singersObject = $this->SingerRepository->findMultiple($recentSingers, 'live', 'basic');
		//  }
		// $this->_validateSections($sections); //maybe

		$basicListingData = $this->listingModel->getListingData($listingId,$status,$sections);

		$listingsData['listingData'] = $basicListingData;

		// echo '<pre>'.print_r($userID,TRUE).'</pre>';
		echo '<pre>'.print_r($listingsData,TRUE).'</pre>';

		return $listingsData;
	}

	public function getMultipleListingsData($listingIds, $status = array('live'),$sections=array('basic')){
		$listingsData = false;
		if(empty($listingIds)){ //check for array also
			return $listingsData;
		}
		return $this->listingModel->getMultipleListingsData($listingIds,$status);
	}

	public function getIds($listingId, $key){
		return $this->listingModel->getIds($listingId, $key);
	}
	
}
?>
