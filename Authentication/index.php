<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> hello</h1>
    <?php
    require_once("User.php");
    require_once("AlterUsersTable.php");
    require_once("Authorization.php");
    require_once("UserValidation.php");
    require_once("PdoConnection.php");
    //require_once("Account.php");
    $user = new User("fortas", "sdffs", "grouni@gmail.com");
    $connection = new PdoConnection();
    var_dump(isset($connection));
    $alterUsers = new AlterUsersTable("userinfo", $connection);
    $authorization = new Authorization($user, $alterUsers);
    $validation = new UserValidation($user);
    $alterUsers->updateUser("email", $user);
    //$2y$10$xjWLep59qOcWlb9mDRkV3uCH5OBWcFxLgAigN2rWY2Z
    //$alterUsers->deleteRecord('username', 'hellopapa');
    //var_dump($authorization->userAuthorized());
    //var_dump(isset($alterUsers->connection));
    //$alterUsers->deleteUser($user);
    //$alterUsers->connection->query("INSERT INTO userinfo (`username`, `password`, `email`) VALUES ('43545353534', 'rw', 'dagjdsgja')");
    /*
    $account = new Account($user, $alterUsers);
    if (!$account->userExist()) {
        $account->addAccount();
    }
    else
        echo "user already in </br>";
    */
    ?>
</body>
</html>