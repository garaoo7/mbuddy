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
		$this->_init('read');

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
				$returnArray[$listingData['ListingID']]['artists'] = $artistIds[$listingData['ListingID']];
			}
			if($listingLeads[$listingData['ListingID']]){
				$returnArray[$listingData['ListingID']]['listingLeads'] = $listingLeads[$listingData['ListingID']];
			}
		}	
		return $returnArray;
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
		return $returnArray;
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
