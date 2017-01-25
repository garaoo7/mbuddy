<?php
	
class Artist_model extends MY_Model{
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

	public function getArtistData($artistId,$status = array('live'),$sections=array('basic')){

		/*$this->_init('read');
		
		$this->dbHandle->select('ListingTitle,ListingViews');

		$this->dbHandle->from('listing');

		$this->dbHandle->where('ListingID',$listingId);

		$this->dbHandle->where_in('Status',$status);

		$listingData = $this->dbHandle->get()->result_array();
		echo $this->dbHandle->last_query();
		print_r($listingData);
		return $listingData[0];
		*/
		//creating temp return data, data should be fetched according to above logic
		$artistData['artistName'] = 'Papa';
		$artistData['artistID'] = '1000';
		return $artistData;
	}

	public function getMultipleArtistsData($artistIds = array(),$status = array('live'),$sections=array('basic')){

		$this->_init('read');
		$artistsData = array();

		// if(array_search("basic",$sections) >= 0){
		// 	$this->dbHandle->select('');

		// 	$this->dbHandle->from('artist');

		// 	$this->dbHandle->where_in('ArtistID',$artistIds);

		// 	$this->dbHandle->where_in('Status',$status);

		// 	$this->dbHandle->join('user', 'user.UserID = listing.UserID');

		// 	$listingResults = $this->dbHandle->get()->result_array();

		// 	foreach ($listingResults as $listingResult){
		// 		$listingsData[$listingResult['ListingID']]['ListingTitle'] = $listingResult['ListingTitle'];
		// 		$listingsData[$listingResult['ListingID']]['ListingViews'] = $listingResult['ListingViews'];
		// 		$listingsData[$listingResult['ListingID']]['Username'] = $listingResult['Username'];
		// 	}
		// }

		// echo $this->dbHandle->last_query();
		// print_r($listingResults);
		// return $listingData[0];
		foreach ($artistIds as $artistId) {
			$artistsData[$artistId]['artistName'] = 'Papa';
			$artistsData[$artistId]['artistID'] = '1000';
		}
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		return $artistsData;
	}
}
