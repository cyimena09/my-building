<?php


class Apartment {
    private $id;
    private $name;
    private $ownerId;
    private $buildingId;

    public function __construct($id, $name, $ownerId, $buildingId) {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->buildingId = $buildingId;
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