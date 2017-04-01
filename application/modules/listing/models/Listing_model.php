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

	public function getListingData($listingId,$status = array('live')){
		$listingId = array($listingId);
		$data = $this->getMultipleListingsData($listingId);
		return $data[current($listingId)];
	}

	public function getMultipleListingsData($listingIds = array(),$status = array('live')){
		_p($listingIds);
		$this->_init('read');
		$listingsData = array();

		$this->dbHandle->select('	ListingID,
								 	ListingTitle,
									ListingViews, 
									ListingLikes, 
									ListingDislikes, 
									ListingUploadDate,
									ListingDescription,
									UserID,
									ListingSourceId,
									ListingSourceLink,
									ListingLyrics,
								'
								);

		$this->dbHandle->from('listing');

		$this->dbHandle->where_in('ListingID',$listingIds);

		$this->dbHandle->where_in('Status',$status);

		$listingResults = $this->dbHandle->get()->result_array();
		$artistIds 		= $this->getRelatedIds($listingIds,'artist');
		$listingLeads   = $this->getListingLeads($listingIds);
		$returnArray    = array();
		foreach ($listingResults as $key=>$listingData) {
			$returnArray[$listingData['ListingID']]['basic'] = $listingData;
			if($artistIds[$listingData['ListingID']]){
				$returnArray[$listingData['ListingID']]['artists'] 		= $artistIds[$listingData['ListingID']];
			}
			if($listingLeads[$listingData['ListingID']]){
				$returnArray[$listingData['ListingID']]['ListingLeads'] 	= $listingLeads[$listingData['ListingID']];
			}
		}	
		return $returnArray;
		
		// foreach ($listingResults as $listingResult){
		// 	$listingsData[$listingResult['ListingID']]['ListingID'] 	= $listingResult['ListingID'];
		// 	$listingsData[$listingResult['ListingID']]['ListingTitle'] 	= $listingResult['ListingTitle'];
		// 	$listingsData[$listingResult['ListingID']]['ListingViews'] 	= $listingResult['ListingViews'];
		// 	$listingsData[$listingResult['ListingID']]['ListingLikes'] 	= $listingResult['ListingLikes'];
		// 	$listingsData[$listingResult['ListingID']]['ListingLikes'] 	= $listingResult['ListingLikes'];
		// 	$listingsData[$listingResult['ListingID']]['ListingDislikes'] = $listingResult['ListingDislikes'];
		// 	$listingsData[$listingResult['ListingID']]['ListingSourceLink'] = $listingResult['ListingSourceLink'];
		// 	$listingsData[$listingResult['ListingID']]['UserID'] = $listingResult['UserID'];
		// 	// $listingsData[$listingResult['ListingID']]['numRows'] = $listingss->num_rows();
		// }

		// echo $this->dbHandle->last_query();
		// print_r($listingResults);
		// return $listingData[0];
		
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		// return $listingsData;
	}

	public function getListingLeads($listingIds){
		$singerIds 		= $this->getRelatedIds($listingIds,'singer');
		$producerIds 	= $this->getRelatedIds($listingIds,'producer');
		$composerIds 	= $this->getRelatedIds($listingIds,'composer');
		$writerIds 		= $this->getRelatedIds($listingIds,'writer');
		$returnArray 	= array();

		foreach ($listingIds as $key => $value) {
			if($singerIds[$value]){
				$returnArray[$value]['singerIds'] 	= $singerIds[$value];
			}
			if($producerIds[$value]){
				$returnArray[$value]['producerIds'] = $producerIds[$value];
			}
			if($composerIds[$value]){
				$returnArray[$value]['composerIds'] = $composerIds[$value];
			}
			if($writerIds[$value]){
				$returnArray[$value]['writerIds'] 	= $writerIds[$value];
			}
		}
		return $returnArray;
	}

	public function getRelatedIds($listingIds, $idKey){
		$this->_init('read');

		$this->dbHandle->select('ListingID,'.ucwords($idKey).'ID');
		$this->dbHandle->from('listing_'.$idKey.'_relation');
		$this->dbHandle->where_in('ListingID',$listingIds);
		$result_array = $this->dbHandle->get()->result_array();
		// _p($this->dbHandle->last_query());
		$returnArray = array();
		foreach ($result_array as $key => $value) {
			$returnArray[$value['ListingID']][] = $value[ucwords($idKey).'ID'];
		}
		return $result_array;
		// if($key == 'artist'){
		// 	$this->dbHandle->select('ListingID,ArtistID');

		// 	$this->dbHandle->from('listing_artist_relation');

		// 	$this->dbHandle->where_in('ListingID',$listingIds);

		// 	$artistResults = $this->dbHandle->get()->result_array();
		// 	foreach ($artistResults as $key=>$artistResult) {
		// 		$artistResults[$artistResult['ListingID']][] = $artistResult['ArtistID'];
		// 		unset($artistResults[$key]);
		// 	}
		// 	return $artistResults;
		// }

		// if($key == 'user'){
		// 	$this->dbHandle->select('ListingID,UserID');

		// 	$this->dbHandle->from('listing');

		// 	$this->dbHandle->where_in('ListingID',$listingIds);

		// 	$userResults = $this->dbHandle->get()->result_array();
		// 	foreach ($userResults as $key=>$userResult) {
		// 		$userResults[$userResult['ListingID']][] = $userResult['UserID'];
		// 		unset($userResults[$key]);
		// 	}
		// 	return $userResults;
		// }

	}

	public function getListingTitle($listingId,$status='live'){
		$this->_init('read');

		$this->dbHandle->select('ListingTitle');
		$this->dbHandle->from('listing');
		$this->dbHandle->where('ListingID', $listingId);
		$this->dbHandle->where('Status',$status);
		$listingTitle = $this->dbHandle->get();
		if($listingTitle->num_rows() > 0){
			$listingTitle = $listingTitle->row();
			return $listingTitle->ListingTitle;
		}
		else{
			return false;
		}
		
	}
}
