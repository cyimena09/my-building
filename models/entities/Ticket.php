<?php


class Ticket {
    private $id;
    private $subject;
    private $status;
    private $description;
    private $dateCreation;
    private $lastUpdate;
    private $fkUser;

    public function __construct($id, $subject, $status, $description, $dateCreation, $lastUpdate, $fkUser) {
        $this->id = $id;
        $this->subject = $subject;
        $this->status = $status;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->lastUpdate = $lastUpdate;
        $this->fkUser = $fkUser;
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