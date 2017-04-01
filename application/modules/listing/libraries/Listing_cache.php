<?php
class Listing_cache{
	private $redisClient;
	private $listingCacheKeyPrefix='listing';
	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();
	}
	
	function getListingObjectFromCache($listingId,$sections){
		$key = $this->listingCacheKeyPrefix.$listingId;
		try{
			$dataFromCache = $this->redisClient->getMembersOfHashByFieldNameWithValue($key,$sections);
		}
		catch(Exception $e){

		}
		if(is_array($dataFromCache)){
			foreach ($dataFromCache as &$value) {
				$value = unserialize($value);
			}	
		}
		if(!$dataFromCache['basic'])
			return false;
		return $dataFromCache;	
	}

	function storeListingObject($listingId,$listingData){
		$key = $this->listingCacheKeyPrefix.$listingId;
		foreach ($listingData as &$value) {
			$value = serialize($value);
		}
		try{
			$this->redisClient->addMembersToHash($key,$listingData);
		}
		catch(Exception $e){

		}
	}

	function storeMultipleListingObject($listingIds,$listingsData){
		try
		{
			foreach ($listingIds as $listingId) {
				$key = $this->listingCacheKeyPrefix.$listingId;
				if(!empty($listingsData[$listingId])){
					foreach ($listingsData[$listingId] as &$value) {
						$value = serialize($value);			
					}

					$this->redisClient->addMembersToHash($key,$listingsData[$listingId],false,true);
				}
			}
			$this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
	}
	function getMultipleListingObjectsFromCache($listingIds,$sections){
		try
		{
			foreach ($listingIds as $listingId) {
				$key = $this->listingCacheKeyPrefix.$listingId;
				$dataFromCache = $this->redisClient->getMembersOfHashByFieldNameWithValue($key,$sections,TRUE);
			}
			$dataFromCache = $this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
		$dataArray   = array();
		if(is_array($dataFromCache)){
			foreach ($dataFromCache as $key1=>&$value) {
				foreach ($value as $key2=>&$sectionData) {
					if(!empty($sectionData)){
						$sectionData = unserialize($sectionData);	
						$dataArray[$key1][$sections[$key2]] = $sectionData;	
					}
				}
			}	
		}
		$returnArray = array();
		foreach ($dataArray as $key => $value) {
			$returnArray[$value['basic']['ListingID']] = $value;
		}
		return $returnArray;
		
	}
}
?>