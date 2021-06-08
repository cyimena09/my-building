<?php


class Message {
    private $id;
    private $name;
    private $description;
    private $dateCreation;
    private $lastUpdate;
    private $sessionToken;
    private $sessionTime;

    public function __construct($id, $name, $description, $dateCreation, $lastUpdate, $sessionToken, $sessionTime) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->lastUpdate = $lastUpdate;
        $this->sessionToken = $sessionToken;
        $this->sessionTime = $sessionTime;
    }

    public function __get($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }

    public function __set($prop, $value) {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }
    
}