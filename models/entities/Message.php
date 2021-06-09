<?php


class Message {
    private $id;
    private $subject;
    private $message;
    private $authorId;
    private $dateCreation;
    private $lastUpdate;

    public function __construct($id, $subject, $message, $authorId, $dateCreation, $lastUpdate) {
        $this->id = $id;
        $this->subject = $subject;
        $this->message = $message;
        $this->authorId = $authorId;
        $this->dateCreation = $dateCreation;
        $this->lastUpdate = $lastUpdate;
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