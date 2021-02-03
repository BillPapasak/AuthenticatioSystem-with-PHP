<?php
require_once("User.php");
require_once("AlterUsersTable.php");
class Account {

    private $user;
    private $alterTable;
    private $usernameExistError;
    private $emailExistError;

    public function __construct($user, $alterTable) {
        $this->user = $user;
        $this->alterTable = $alterTable;
        $this->usernameExistError = '';
        $this->emailExistError = '';
    }

    /*
    private function usernameExist() :bool {
        $user = $this->alterTable->getUser($this->user->getUsername());
        if (is_array($user)) {
            $this->usernameExistError = "A user with that name already exist";
            return true;
        }
        return false;
    }

    private function emailExist() :Bool {
        $user = $this->alterTable->getUsere($this->user->getEmail());
        print_r($user);
        if (is_array($user)) {
            $this->emailExistError = "A user with that email already exists";
            return true;
        }
        return false;
    }

    public function userExist() :Bool {
        return ($this->usernameExist() || $this->emailExist()) ? true:false;
    }
    */
    public function addAccount() :void {
        $this->alterTable->addUser($this->user->getUsername(), $this->user->getPassword(), $this->user->getEmail());
    }

    public function deleteAccount() :void {

    }

    public function updateAccount():void {
        
    }
        
}
?>