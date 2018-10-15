<?php

class Interests {

    private $preference;
    private $quality;
    private $live_without;
    private $smokes;
    private $drinks;
    private $has_children;
    private $has_pets;

    public function __construct($preferences, $quality, $live_without, $smokes, $drinks, $has_children, $has_pets) {
        $this->preference = $preferences;
        $this->quality = $quality;
        $this->live_without = $live_without;
        $this->smokes = $smokes;
        $this->drinks = $drinks;
        $this->has_children = $has_children;
        $this->has_pets = $has_pets;
    }

    public function getPreference() {
        return $this->preference;
    }

    public function setPreference($value) {
        $this->preference = $value;
    }

    public function getQuality() {
        return $this->quality;
    }

    public function setQuality($value) {
        $this->quality = $value;
    }

    public function getLiveWithout() {
        return $this->live_without;
    }

    public function setLiveWithout($value) {
        $this->live_without = $value;
    }

    public function getSmokes() {
        return $this->smokes;
    }

    public function setSmokes($value) {
        $this->smokes = $value;
    }

    public function getDrinks() {
        return $this->drinks;
    }

    public function setDrinks($value) {
        $this->drinks = $value;
    }

    public function getHasChildren() {
        return $this->has_children;
    }

    public function setHasChildren($value) {
        $this->has_children = $value;
    }

    public function getHasPets() {
        return $this->has_pets;
    }

    public function setHasPets($value) {
        $this->has_pets = $value;
    }
    
}

?>