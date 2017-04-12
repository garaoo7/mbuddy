<?php
class Tag_cache{
	private $redisClient;
	private $tagCacheKeyPrefix='tag';
	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();
	}
	
	function getTagObjectFromCache($tagId,$sections){
		$key = $this->tagCacheKeyPrefix.$tagId;
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

	function storeTagObject($tagId,$tagData){
		$key = $this->tagCacheKeyPrefix.$tagId;
		foreach ($tagData as &$value) {
			$value = serialize($value);
		}
		try{
			$this->redisClient->addMembersToHash($key,$tagData);
		}
		catch(Exception $e){

		}
	}

	function storeMultipleTagObject($tagIds,$tagsData){
		try
		{
			foreach ($tagIds as $tagId) {
				$key = $this->tagCacheKeyPrefix.$tagId;
				if(!empty($tagsData[$tagId])){
					foreach ($tagsData[$tagId] as &$value) {
						$value = serialize($value);			
					}

					$this->redisClient->addMembersToHash($key,$tagsData[$tagId],false,true);
				}
			}
			$this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
	}
	function getMultipleTagObjectsFromCache($tagIds,$sections){
		try
		{
			foreach ($tagIds as $tagId) {
				$key = $this->tagCacheKeyPrefix.$tagId;
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
			$returnArray[$value['basic']['TagID']] = $value;
		}
		return $returnArray;
		
	}
}
?>