<?php

class Singer_url {

	private $ci;
	private $singerModel;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("singer/singer_model");
		$this->singerModel = new singer_model();
	}
//url_builder lib name
	//validate_url for below function

	public function getSingerUrl($singerId){
		//validate the singer for the given singerId
		$singerName = $this->singerModel->getSingerName($singerId);
		if($singerName == false){
			return false;
		}
		else{
			$url = convertTextToUrl($singerName);
			return "singer/"."$url/$singerId";
		}

	}
}

?>