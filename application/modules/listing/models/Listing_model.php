<?php
	
class Listing_model extends MY_Model{
// we might do call by reference for each input in each function below
	private $dbHandle;
	private function _init($handle = 'read'){
		if($handle=='read'){
			$this->dbHandle = $this->getReadHandle();
		}
		else if($handle=='write'){
			$this->dbHandle = $this->getWriteHandle();
		}
	}

	public function getListingData($listingId,$status = array('live'),$sections=array('basic')){

		$this->_init('read');
		$listingData = array();

		if(in_array('basic',$sections)){
			$this->dbHandle->select('ListingID, ListingTitle, ListingViews');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('ListingID',$listingId);

			$this->dbHandle->where_in('Status',$status);

			$listingData = $this->dbHandle->get()->row_array();

		}

		if(in_array('full',$sections)){
			$this->dbHandle->select('ListingID, ListingTitle, ListingViews, ListingLikes, ListingDislikes');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('ListingID',$listingId);

			$this->dbHandle->where_in('Status',$status);

			$listingData = $this->dbHandle->get()->row_array();

		}
		//creating temp return data, data should be fetched according to above logic
		// $listingData['ListingTitle'] = 'Papa';
		// $listingData['ListingViews'] = '1000';
		return $listingData;
	}

	public function getMultipleListingsData($listingIds = array(),$status = array('live'),$sections=array('basic')){

		$this->_init('read');
		$listingsData = array();

		if(in_array('basic',$sections)){
			$this->dbHandle->select('ListingID, ListingTitle, ListingViews');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('ListingID',$listingId);

			$this->dbHandle->where_in('Status',$status);

			$listingResults = $this->dbHandle->get()->result_array();

			foreach ($listingResults as $listingResult){
				$listingsData[$listingResult['ListingID']]['ListingTitle'] = $listingResult['ListingTitle'];
				$listingsData[$listingResult['ListingID']]['ListingViews'] = $listingResult['ListingViews'];
			}
		}

		if(in_array('full',$sections)){
			$this->dbHandle->select('ListingID, ListingTitle, ListingViews, ListingLikes, ListingDislikes');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('ListingID',$listingId);

			$this->dbHandle->where_in('Status',$status);

			// $listingss = $this->dbHandle->get();
			// $listingResults = $listingss->result_array();
			$listingResults = $this->dbHandle->get()->result_array();

			// echo $this->dbHandle->last_query();
			// die();

			foreach ($listingResults as $listingResult){
				$listingsData[$listingResult['ListingID']]['ListingTitle'] = $listingResult['ListingTitle'];
				$listingsData[$listingResult['ListingID']]['ListingViews'] = $listingResult['ListingViews'];
				$listingsData[$listingResult['ListingID']]['ListingLikes'] = $listingResult['ListingLikes'];
				$listingsData[$listingResult['ListingID']]['ListingDislikes'] = $listingResult['ListingDislikes'];
				// $listingsData[$listingResult['ListingID']]['numRows'] = $listingss->num_rows();
			}
		}

		// echo $this->dbHandle->last_query();
		// print_r($listingResults);
		// return $listingData[0];
		
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		return $listingsData;
	}

	public function getIds($listingId, $key){
		$this->_init('read');

		$arrayId = array();

		if($key == 'artist'){
			$this->dbHandle->select('ArtistID');

			$this->dbHandle->from('listing_artist_relation');

			$this->dbHandle->where_in('ListingID',$listingId);

			$artistResults = $this->dbHandle->get()->result_array();
			foreach ($artistResults as $artistResult) {
				array_push($arrayId, $artistResult['ArtistID']);
			}
		}

		if($key == 'user'){
			$this->dbHandle->select('UserID');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('ListingID',$listingId);

			$userResult = $this->dbHandle->get()->row_array();
			$arrayId = $userResult['UserID'];
		}


		return $arrayId;
	}
}
