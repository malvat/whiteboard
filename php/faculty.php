<?php

class Faculty {

    // class variables
    private $id;
    private $branch;
    
    function __construct($id, $branch) {
        $this->id = $id;
        $this->branch = $branch;
    }
    
    // setters and getter for these values

    // setters
    public function setId($temp) {
        $this->id = $temp;
    }

    public function setBranch($temp) {
        $this->branch = $temp;
    }

    // getters
    public function getId() {
        return $this->id;
    }
    
    public function getBranch() {
        return $this->branch;
    }
}
?>