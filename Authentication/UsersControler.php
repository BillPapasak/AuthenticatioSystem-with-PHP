<?php
require_once("User.php");
require_once("AlterUsersTable.php");
require_once("Authorization.php");
require_once("UserValidation.php");
require_once("PdoConnection.php");
require_once("View.php");
require_once("Controler.php");
class UsersControler extends Controler {

    public function register() {
        $user = new User($_POST['username'], $_POST['password'], $_POST['email']);
        $connection = new PdoConnection();
        $alterUsers = new AlterUsersTable("userinfo", $connection);
        $authorization = new Authorization($user, $alterUsers);
        $validation = new UserValidation($user);
        $validated = $validation->userValidated();
        if ($validated) {
            if (!$authorization->userExist()) {
                $alterUsers->addUser($user);
                return new View("Location:register_page.php", []);
            }
            else 
                return new View("Location:Register2.php?", ["usernameError"=>$authorization->getUsernameError(), 
                                                        "passwordError"=>$authorization->getPasswordError(),
                                                        "emailError"=>$authorization->getEmailError()]);
        }
        else 
            return new View("Location:Register2.php", ["usernameError"=>$validation->getUsernameError(), 
                                                        "passwordError"=>$validation->getPasswordError(),
                                                        "emailError"=>$validation->getEmailError()]);
    }

    public function login() {
        $user = new User($_POST['username'], $_POST['password'], "");
        $connection = new PdoConnection();
        $alterUsers = new AlterUsersTable("userinfo", $connection);
        $authorization = new Authorization($user, $alterUsers);
        if ($authorization->userAuthorized()) {
          return new View("Location:register_page.php", array());
        }else {
            return new View("Location:Login.php", ["usernameError"=>$authorization->getUsernameError(), 
                                                        "passwordError"=>$authorization->getPasswordError()]);
        }
          
    }

    public function resetPassword() {
        $user = new User("", $_POST['password'], $_POST['email']);
        $connection = new PdoConnection();
        $alterUsers = new AlterUsersTable("userinfo", $connection);
        $validation = new UserValidation($user);
        $authorization = new Authorization($user, $alterUsers);
        if ($validation->validateEmail() && $authorization->emailExist()) {
            $passwordValidated = $validation->validatePassword();
            $passwordMatch = $validation->validateConfirmationPassowrd($_POST['confirmPassword']);
            if ($passwordValidated && $passwordMatch) {
                $alterUsers->updateUser("email", $user);
            }
            else {
                return new View("Location:ResetPassword.php", [ 
                                                            "passwordError"=>$validation->getPasswordError(),
                                                            "confirmationPassError"=>$validation->getConfirmationPasswordError(),"email"=>$user->getEmail()]);
            }
        }else {
            return new View("Location:ResetPassword.php", ["emailError"=>$validation->getEmailError(),
                                                            "emError"=>$authorization->getEmailError()
                                                            ]);
        }
    }
}
?>