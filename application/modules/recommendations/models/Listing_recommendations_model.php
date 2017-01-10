<?php

class Listing_recommendations_model extends MY_Model{

	public function get_recent_listings($userValidation){
		if(!$userValidation)
			return array();
		return array('130', '142', '145');

	}
  }

//array(1,2,3,4,'custom'=>array("cool","nice"));
?>

