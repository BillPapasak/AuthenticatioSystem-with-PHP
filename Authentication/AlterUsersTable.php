<?php
require_once("AlterTable.php");
require_once("User.php");

class AlterUsersTable extends AlterTable {
    

    public function getUser($attribute, $value) {
            return $this->getRecord($attribute, $value);
    }

    public function addUser(User $user) :void {
        $userDetails = ['username'=>$user->getUsername(),
                        'password'=>password_hash($user->getPassword(), PASSWORD_DEFAULT),
                        'email'=>$user->getEmail()];
        $this->insert($userDetails);
    }

    public function deleteUser(User $user) :void {
        $this->deleteRecord('username', $user->getUsername());
    }

    //$ attribute with what criteria the password will change where $attribute = ...
    public function updateUser($attribute, User $user) :void {
        $userDetails = ['password'=>password_hash($user->getPassword(), PASSWORD_DEFAULT)];
        $this->update($userDetails, $attribute, $user->getEmail());  
    }
}
?>