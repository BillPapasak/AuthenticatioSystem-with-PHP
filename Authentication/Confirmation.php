<?php

class Confirmation {
    protected $user;
    protected $usernameError;
    protected $passwordError;
    protected $emailError;

    public function __construct(User $user) {
        $this->user = $user;
        $this->usernameError = '';
        $this->passwordError = '';
        $this->emailError = '';
    }

    public function getUsernameError() :String {
        return $this->usernameError;
    }

    public function getPasswordError() :String {
        return $this->passwordError;
    }

    public function getEmailError() :String {
        return $this->emailError;
    }

}
?>