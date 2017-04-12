<?php

class Tag_url {

	private $ci;
	private $tagModel;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("tag/tag_model");
		$this->tagModel = new tag_model();
	}
//url_builder lib name
	//validate_url for below function

	public function getTagUrl($tagId){
		//validate the tag for the given tagId
		$tagName = $this->tagModel->getTagName($tagId);
		if($tagName == false){
			return false;
		}
		else{
			$url = convertTextToUrl($tagName);
			return "tag/$url/$tagId";
		}

	}
}

?>