<?php


class Apartment {
    private $id;
    private $name;
    private $owner;
    private $building;
    private $tenants;
    private $nbTenants;

    public function __construct($id, $name, $owner, $building) {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
        $this->building = $building;
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