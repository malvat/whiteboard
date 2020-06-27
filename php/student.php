<?php

class Student {

    // class variables
    private $cc_id;
    private $branch;
    private $enrolment;
    private $class_id;

    //constructor
    function __construct($cc_id, $branch, $enrolment, $class_id) {
        $this->cc_id = $cc_id;
        $this->branch = $firstname;
        $this->enrolment = $lastname;
        $this->class_id = $class_id;
    }
    // setters and getter for these values

    // setters
    public function setCC($temp) {
        $this->cc_id = $temp;
    }

    public function setBranch($temp) {
        $this->branch = $temp;
    }

    public function setEnrolment($temp) {
        $this->enrolment = $temp;
    }

    public function setClassId($temp) {
        $this->class_id = $temp;
    }

    // getters
    public function getCC() {
        return $this->cc_id;
    }

    public function getBranch() {
        return $this->branch;
    }

    public function getEnrolment() {
        return $this->enrolment;
    }
    
    public function getClassId() {
        return $this->class_id;
    }
    
   
}

?>