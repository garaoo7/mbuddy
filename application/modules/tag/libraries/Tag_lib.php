<?php

class Tag_lib{

	private $tagModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct($tagModel){
		if(!empty($tagModel)){
			$this->tagModel = $tagModel;
		}
		$this->ci =& get_instance();
	}

	public function getSectionWiseTagData($tagId){
		$tagData = false;
		if(empty($tagId)){
			return $tagData;
		}

		return $this->tagModel->getTagData($tagId);
	}

	public function getSectionWiseMultipleTagsData($tagIds){
		$tagsData = array();
		if(empty($tagIds) || !is_array($tagIds) || count($tagIds)==0){
			return $tagData;
		}
		
		return $this->tagModel->getMultipleTagsData($tagIds);
	}

	public function getRelatedIds($tagIds, $key){
		return $this->tagModel->getRelatedIds($tagIds, $key);
	}
	
}
?>
