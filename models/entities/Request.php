<?php


class Request {
    private $id;
    private $isOwnerRequest;
    private $apartment;
    private $user;

    public function __construct($id, $isOwnerRequest, $apartment, $user) {
        $this->id = $id;
        $this->isOwnerRequest = $isOwnerRequest;
        $this->apartment = $apartment;
        $this->user = $user;
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