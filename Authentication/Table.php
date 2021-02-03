<?php
class Table {

    private $attributes;

    public function __construct() {
        $this->attributes = array();
    }

    public function addAttribute(String $attribute) :void {
        array_push($this->attributes, $attribute);
    }

    public function addAttributes($attributes) {}
    }

?>