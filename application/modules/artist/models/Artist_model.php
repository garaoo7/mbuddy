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

		$artistId = array($artistId);
		$data = $this->getMultipleArtistsData($artistId);
		return $data[current($artistId)];
	}

	public function getMultipleArtistsData($artistIds = array(),$status = array('live'),$sections = array('basic')){

		$this->_init('read');
		$artistsData = array();


		 	$this->dbHandle->select('ArtistName, ArtistID');

		 	$this->dbHandle->from('artist');

		 	$this->dbHandle->where_in('ArtistID',$artistIds);

		 	$this->dbHandle->where_in('Status',$status);

		// 	$this->dbHandle->join('user', 'user.UserID = listing.UserID');

			$artistResults = $this->dbHandle->get()->result_array();

		 	foreach ($artistResults as $artistResult){
		 		$artistsData[$artistResult['ArtistID']]['basic'] = $artistResult;
		 	}

		return $artistsData;
	}
}
