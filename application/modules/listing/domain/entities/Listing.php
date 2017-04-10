<?php

class Listing {
	
    private $ListingID;
	private $ListingTitle;
	private $ListingViews;
	private $ListingLikes;
    private $ListingDislikes;
    private $ListingSourceId;
    private $ListingSourceLink;
    private $ArtistObject;
    private $UserObject;
    private $ListingLeads;
    private $ListingUploadDate;
    private $ListingDescription;
    private $ListingLyrics;

    public function getListingUrl(){
        $id     = $this->getListingID();
        $text   = convertTextToUrl($this->getListingTitle());
        return MBUDDY_HOME.$text."/".$id;
    }

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

    public function getListingSourceLink(){
        return $this->ListingSourceLink;
    }

    public function getArtistObject(){
        return $this->ArtistObject;
    }
    
    public function getUserObject(){
        return $this->UserObject;
    }

    public function getListingLeads(){
        return $this->ListingLeads;
    }

    public function getListingUploadDate(){
        return $this->ListingUploadDate;
    }

    public function getListingSourceId(){
        return $this->ListingSourceId;
    }
    
    public function getListingLyrics(){
        return $this->ListingLyrics;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	