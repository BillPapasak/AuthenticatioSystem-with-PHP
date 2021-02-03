<?php
require_once("Confirmation.php");

class Authorization extends Confirmation{
    private $alterTable;
    //private $loginError;
    public function __construct(User $user, AlterTable $alterTable) {
        $this->alterTable = $alterTable;
        //$this->loginError = "";
        parent::__construct($user);
    }

    private function usernameExist() :bool {
        $user = $this->alterTable->getUser('username', $this->user->getUsername());
        if (is_array($user)) {
            $this->usernameError = "A user with that name already exist";
            return true;
        }
        return false;
    }

    public function emailExist() :Bool {
        $user = $this->alterTable->getUser('email', $this->user->getEmail());
        if (is_array($user)) {
            $this->emailError = "A user with that email already exists";
            return true;
        }
        $this->emailError = "A user with that email doesn't exist";
        return false;
    }

    public function userAuthorized() :Bool{
        $user = $this->alterTable->getUser('username', $this->user->getUsername());
        if (is_array($user)) {
            if (password_verify($this->user->getPassword(), $user['password'])) {
                return true;
            }
            else {
                $this->passwordError = "Incorrect  Password";
                return false;
            }
        } 
        else {
            $this->usernameError = "Incorrect Username";
            return false;
        }
    }

    public function userExist() :Bool {
        $checkUsername = $this->usernameExist();
        $checkEmail = $this->emailExist();
        return ($checkUsername || $checkEmail) ? true:false;
    }

    
    
}
?>