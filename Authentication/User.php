<?php
//https://m.do.co/c/f345c9feb0f1
//http://138.68.79.158/


class User {
    protected $username;
    protected $password;
    protected $email;
    

    public function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

   public function getUsername () :String {
       return $this->username;
   }

   public function getPassword () :String {
       return $this->password;
   }

   public function setUsername (String $newUsername) :void {
        $this->$username = $newUsername;
   }

   public function setPassword (String $newPassword) :void {
       $this->password = $newPassword;
   }

   public function getEmail() :String {
       return $this->email;
   }

   public function setEmail (String $newEmail) :void {
       $this->email = $newEmail;
   }




}   
?>