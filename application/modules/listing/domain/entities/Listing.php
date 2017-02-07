<?php

class Listing {
	
	private $ListingTitle;
	private $ListingViews;
	private $ListingLikes;
    private $ListingDislikes;
	private $UserID;

	public function getListingTitle(){
        return $this->ListingTitle;
    }

    public function getListingViews(){
        return $this->ListingViews;
    }

    public function getListingLikes(){
        return $this->ListingLikes;
    }

    public function getListingDislikes(){
        return $this->ListingDislikes;
    }
    public function getUserID(){
        return $this->UserID;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	