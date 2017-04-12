<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tag_controller extends MX_Controller{

	private $tagUrl;

	public function __construct(){
		 $this->load->library('tag/tag_url');
		 $this->load->builder('tag/Tag_builder');
		 $this->TagBuilder = new Tag_builder();
		 $this->TagRepository = $this->TagBuilder->getTagRepository();
		 $this->load->helper('url');
		 $this->tagUrl = new tag_url();

	}

	public function index($tagId=false){
		
		//place checks listingid validation
		$url = $this->tagUrl->getTagUrl($tagId);
		if($url == false){
			show_error_page();
		}
		else if(getRelativeUrl() != $url){
			redirect(MBUDDY_HOME.$url);
		}
		else{
			$tagObject = $this->TagRepository->find($tagId,array('full'));
			$displayData['tagData'] = $tagObject;
			_p($tagObject);
			die;
			$this->load->view('tagPage', $displayData);
			
			// echo "<br><br><br><br>";
			//echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		}

		
	}
}
?>