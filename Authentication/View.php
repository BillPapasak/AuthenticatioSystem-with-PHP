<?php
session_start();
class View {
    private $location;
    private $passValues;
    public function __construct(String $location, Array $passValues) {
        $this->location = $location;
        $this->passValues = $passValues;
        //$query = http_build_query($this->passValues);
        $this->passValues();
        header("$this->location");
        

        
    }

    public function passValues() :void {
        print_r($_SESSION);
        foreach (array_keys($this->passValues) as $value) {
            $_SESSION[$value] = $this->passValues[$value];
        }
    }
}
?>