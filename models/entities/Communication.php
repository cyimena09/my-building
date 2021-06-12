<?php


class Communication {
    private $id;
    private $subject;
    private $message;
    private $dateCreation;
    private $lastUpdate;
    private $idBuilding;

    public function __construct($id, $subject, $message, $dateCreation, $lastUpdate, $idBuilding) {
        $this->id = $id;
        $this->subject = $subject;
        $this->message = $message;
        $this->dateCreation = $dateCreation;
        $this->lastUpdate = $lastUpdate;
        $this->idBuilding = $idBuilding;
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