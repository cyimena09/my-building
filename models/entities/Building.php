<?php


class Building {
    private $id;
    private $name;
    private $address;
    private $apartments;
    private $nbApartments; // nombre d'apartement dans un immeuble

    public function __construct($id, $name, $apartments, $address) {
        $this->id = $id;
        $this->name = $name;
        $this->apartments = $apartments;
        $this->address = $address;
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