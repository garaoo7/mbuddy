<?php

class User_recommendations_model extends MY_Model{

	public function get_recent_users($userValidation){
		if(!$userValidation)
			return array();
		return array('150', '166', '167');

	}
  }

//array(1,2,3,4,'custom'=>array("cool","nice"));
?>

