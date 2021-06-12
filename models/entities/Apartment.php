<?php


class Apartment {
    private $id;
    private $name;
    private $ownerId;
    private $idBuilding;

    public function __construct($id, $name, $ownerId, $idBuilding) {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
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