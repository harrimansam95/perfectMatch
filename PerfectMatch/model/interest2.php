<?php

class Interest2 {

    private $interest1;
    private $interest2;
    private $interest3;
    private $interest4;
    private $user_bio;

    public function __construct($interest1, $interest2, $interest3, $interest4, $user_bio) {

        $this->interest1 = $interest1;
        $this->interest2 = $interest2;
        $this->interest3 = $interest3;
        $this->interest4 = $interest4;
        $this->user_bio = $user_bio;
    }

    public function getInterest1() {
        return $this->interest1;
    }

    public function getInterest2() {
        return $this->interest2;
    }

    public function getInterest3() {
        return $this->interest3;
    }

    public function getInterest4() {
        return $this->interest4;
    }
    public function getUserBio() {
        return $this->user_bio;
    }

    public function setInterest1($value) {
        $this->interest1 = $value;
    }

    public function setInterest2($value) {
        $this->interest2 = $value;
    }

    public function setInterest3($value) {
        $this->interest3 = $value;
    }

    public function setInterest4($value) {
        $this->interest4 = $value;
    }
    public function setUserBio($value) {
        $this->user_bio = $value;
    }

}
?>