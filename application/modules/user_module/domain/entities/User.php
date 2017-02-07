<?php

class User {

	private $Username;

	private $FirstName;
	
	private $LastName;

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
	