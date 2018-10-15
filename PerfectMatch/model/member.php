<?php

class Member {

    private $username;
    private $displayName;
    private $password;
    private $email;
  

    public function __construct($username, $password, $email, $displayName) {
        $this->username = $username;
        $this->displayName = $displayName;
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($value) {
        $this->username = $value;
    }
    public function getDisplayName() {
        return $this->displayName;
    }

    public function setDisplayName($value) {
        $this->displayName = $value;
    }

}

?>