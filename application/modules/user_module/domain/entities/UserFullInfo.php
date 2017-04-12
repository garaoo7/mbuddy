<?php

class UserFullInfo {

	private $UserID;
	private $Username;
	private $Email;
	private $FirstName;
	private $LastName;
	private $DateOfBirth;
	private $Gender;
	private $Mobile;
	private $FollowersCount;
	private $FollowingCount;
	private $TagsCount;
	private $AboutMe;
	private $Rating;
	private $FacebookID;
	private $GoogleID;
	private $CityName;
	private $CountryName;
	private $ProfessionName;
	private $GroupName;
	private $ListingObject;
	private $TagObject;


	public function getUserID(){
	    return $this->UserID;
	}

	public function getUsername(){
	    return $this->Username;
	}

	public function getEmail(){
	    return $this->Email;
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

	public function getRating(){
	    return $this->Rating;
	}

	public function getFacebookID(){
	    return $this->FacebookID;
	}

	public function getGoogleID(){
	    return $this->GoogleID;
	}

	public function getCityName(){
	    return $this->CityName;
	}

	public function getCountryName(){
	    return $this->CountryName;
	}
	
	public function getProfessionName(){
	    return $this->ProfessionName;
	}

	public function getGroupName(){
	    return $this->GroupName;
	}

	public function getListingObject(){
	    return $this->ListingObject;
	}

	public function getTagObject(){
	    return $this->TagObject;
	}

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	