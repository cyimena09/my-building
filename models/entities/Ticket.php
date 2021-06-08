<?php


class Ticket {
    private $id;
    //private $name;
    private $description;
    private $status;
    private $dateCreation;
    private $assigned;
    private $lastUpdate;

    public function __construct($id, $description, $status, $dateCreation = false, $lastUpdate = false) {
        $this->id = $id;
        //$this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->dateCreation = $dateCreation;
        //$this->assigned = $assigned;
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