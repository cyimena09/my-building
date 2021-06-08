<?php


class Address {
    private $id;
    private $street;
    private $houseNumber;
    private $boxNumber;
    private $zip;
    private $city;
    private $country;
    private $userId;

    public function __construct($id, $street, $houseNumber, $boxNumber, $zip, $city, $country, $userId) {
        $this->id = $id;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->boxNumber = $boxNumber;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
        $this->userId = $userId;
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

