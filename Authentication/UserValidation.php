<?php
require_once("Validation.php");
require_once("Confirmation.php");

class UserValidation extends Confirmation implements Validation  {
    private $confirmationPassword;

    public function __construct(User $user) {
        $this->confirmationPasswordError = '';
        parent::__construct($user);
    }
    public function validateUsername () :Bool {
        $username = $this->user->getUsername();
        //var_dump($username);
        if ($username == '') {
            $this->usernameError = "Username cannot be empty";
            return false;
        }
        else if (!(mb_strlen($username) > 7 && mb_strlen($username) < 20)) {
            $this->usernameError = "Username must be at least 8 characters long";
            return false;
        }
        return true; 
    }
    
    public function validatePassword() :Bool {
        $password = $this->user->getPassword();
        if ($password == '') {
            $this->passwordError = "Enter a password";
            return false;
        }
        if (!($this->passLength($password) && $this->hasSpecialCharacters($password) && $this->hasNumbers($password))) {
            $this->passwordError = "Please choose a stronger password";
            return false;
        }
        return true;
        
    }

    public function validateEmail() :Bool {
        $email  = $this->user->getEmail();
        if ($email == '') {
            $this->emailError = "Enter an email adress";
            return false;
        }
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $this->emailError = "Enter a valid email adress";
            return false;
        }
        return true;
    }

    public function validateConfirmationPassowrd(String $confirmationPassword) :Bool {
        $password = $this->user->getPassword();
        echo $password;
        if (!($password == $confirmationPassword)) {
            $this->confirmationPasswordError = "passwords don't match";
            return false;
        }
        return true;
    }

    public function userValidated() :Bool {
        $vur = $this->validateUsername();
        $vpas = $this->validatePassword();
        $vem = $this->validateEmail();
        return ($vur && $vpas && $vem) ? true:false;
    }

    public function getConfirmationPasswordError() :String {
        return $this->confirmationPasswordError;
    }

    private function passLength($password) :Bool{
        return (mb_strlen($password) > 8) ? true:false;
    }

    private function hasSpecialCharacters($password) :Bool{
        return preg_match('/[@_#$&+-]/', $password) ? true:false;
    }

    private function hasNumbers($password) :Bool {
        return preg_match('/[0123456789]/', $password) ? true:false;
    }

}
?>