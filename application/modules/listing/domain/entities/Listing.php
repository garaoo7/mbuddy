<?php

class Listing {
	
    private $ListingID;
	private $ListingTitle;
	private $ListingViews;
	private $ListingLikes;
    private $ListingDislikes;
    private $ArtistObject;
    private $UserObject;


    public function getListingID(){
        return $this->ListingID;
    }
    
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

    public function getArtistObject(){
        return $this->ArtistObject;
    }
    
    public function getUserObject(){
        return $this->UserObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	