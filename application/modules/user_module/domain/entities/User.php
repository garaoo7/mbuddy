<?php

class User {

	private $UserID;
	private $Username;
	private $FirstName;
	private $LastName;
	private $DateOfBirth;
	private $Gender;
	private $City;
	private $Country;
	private $Mobile;
	private $FollowersCount;
	private $FollowingCount;
	private $TagsCount;
	private $AboutMe;


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

	public function getDateOfBirth(){
	    return $this->DateOfBirth;
	}

	public function getGender(){
	    return $this->Gender;
	}

	public function getCity(){
	    return $this->City;
	}

	public function getCountry(){
	    return $this->Country;
	}

	public function getMobile(){
	    return $this->Mobile;
	}

	public function getFollowersCount(){
	    return $this->FollowersCount;
	}

	public function getFollowingCount(){
	    return $this->FollowingCount;
	}

	public function getTagsCount(){
	    return $this->TagsCount;
	}

	public function getAboutMe(){
	    return $this->AboutMe;
	}

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	