<?php

class Singer {

	private $SingerID;
	private $SingerName;

    public function getSingerID(){
                return $this->SingerID;
    }
	public function getSingerName(){
        return $this->SingerName;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	