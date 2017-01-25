<?php

class Listing_assembly_lib{

	private $listingModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct($listingModel){
		if(!empty($listingModel) &&){
			$this->listingModel = $listingModel;
		}
		$this->ci =& get_instance();
	}

	public function getListingData($listingId, $status = array('live'),$sections=array('basic')){
		$listingData = false;
		if(empty($listingId)){
			return $listingData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->listingModel->getListingData($listingId,$status);
	}

	public function getMultipleListingsData($listingIds, $status = array('live'),$sections=array('basic')){
		$listingsData = false;
		if(empty($listingIds)){ //check for array also
			return $listingsData;
		}
		// $this->_validateSections($sections); //maybe
		if($sections=='full'){
			$this->ci->load->builder('listing/Listing_builder');
			$this->ci->load->builder('artist/Artist_builder');
			$this->ArtistBuilder = new Artist_builder();
			$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();
		 	$recentArtists = array('107', '108', '101');
		 	$artistsObject = $this->ArtistRepository->findMultiple($recentArtists, 'live', 'basic');
		 	echo '<pre>'.print_r($artistsObject,TRUE).'</pre>';
		 }
		// if($sections)
		return $this->listingModel->getMultipleListingsData($listingIds,$status);
	}	
	
}
?>
