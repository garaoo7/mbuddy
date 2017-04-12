<?php
class Artist_cache{
	private $redisClient;
	private $artistCacheKeyPrefix='artist';
	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();
	}
	
	function getArtistObjectFromCache($artistId,$sections){
		$key = $this->artistCacheKeyPrefix.$artistId;
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

	function storeArtistObject($artistId,$artistData){
		$key = $this->artistCacheKeyPrefix.$artistId;
		foreach ($artistData as &$value) {
			$value = serialize($value);
		}
		try{
			$this->redisClient->addMembersToHash($key,$artistData);
		}
		catch(Exception $e){

		}
	}

	function storeMultipleArtistObject($artistIds,$artistsData){
		try
		{
			foreach ($artistIds as $artistId) {
				$key = $this->artistCacheKeyPrefix.$artistId;
				if(!empty($artistsData[$artistId])){
					foreach ($artistsData[$artistId] as &$value) {
						$value = serialize($value);			
					}

					$this->redisClient->addMembersToHash($key,$artistsData[$artistId],false,true);
				}
			}
			$this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
	}
	function getMultipleArtistObjectsFromCache($artistIds,$sections){
		try
		{
			foreach ($artistIds as $artistId) {
				$key = $this->artistCacheKeyPrefix.$artistId;
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
			$returnArray[$value['basic']['ArtistID']] = $value;
		}
		return $returnArray;
		
	}
}
?>