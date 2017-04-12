<?php

class UserBasic {

	private $UserID;
	private $Username;
	private $FirstName;
	private $LastName;

	public function getUserID(){
	    return $this->UserID;
	}

	public function getUsername(){
	    return $this->Username;
	}

	public function getFirstName(){
        return $this->FirstName;
    }

    public function getLastName(){
        return $this->LastName;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	