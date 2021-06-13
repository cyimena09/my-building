<?php


class User {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $gender;
    private $role;
    private $apartment;
    private $building;
    private $password;
    private $sessionToken;
    private $sessionTime;

    public function __construct($id, $firstName, $lastName, $email, $phone, $gender, $role, $password = false, $sessionToken = false, $sessionTime = false) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->role = $role;
        $this->password = $password;
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