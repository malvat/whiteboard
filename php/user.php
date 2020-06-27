<?php

class User {

    // class variables
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $contact;
    
    function __construct($id, $firstname, $lastname, $email, $password, $contact) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->contact = $contact;
    }
    
    // setters and getter for these values

    // setters
    public function setId($temp) {
        $this->id = $temp;
    }

    public function setFirstname($temp) {
        $this->firstname = $temp;
    }

    public function setLastName($temp) {
        $this->lastname = $temp;
    }

    public function setEmail($temp) {
        $this->email = $temp;
    }

    public function setPassword($temp) {
        $this->password = $temp;
    }

    public function setContact($temp) {
        $this->contact = $temp;
    }

    // getters
    public function getId() {
        return $this->id;
    }
    
    public function getFirstName() {
        return $this->firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function getContact() {
        return $this->contact;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
   
}

?>