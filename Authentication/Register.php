
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href=".//styleform.css">
</head>
<body>

<h2 class="form-title">Create ur Account</h2>
<?php

session_start();
if (!(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email']))) {
  require_once("User.php");
  require_once("AlterUsersTable.php");
  require_once("Authorization.php");
  require_once("UserValidation.php");
  require_once("PdoConnection.php");
  //require_once("Account.php");
  $user = new User($_POST['username'], $_POST['password'], $_POST['email']);
  $connection = new PdoConnection();
  //var_dump(isset($connection));
  $alterUsers = new AlterUsersTable("userinfo", $connection);
  $authorization = new Authorization($user, $alterUsers);
  $validation = new UserValidation($user);
  echo $validation->getPasswordError();
  $validated = $validation->userValidated();
  if ($validated){
    $_POST['authorization'] = true;
    if (!$authorization->userExist()) {
      //$_POST['authorization'] = true;
      $alterUsers->addUser($user);
      echo "sdfsdf";
      header('Location:register_page.php');
      exit();
    }
  
  }
}
?>

<div class="login-page">
  <div class="form">
    <form class="register-form" action="Register.php" method = "POST">
      <div>
        <input type="text" id="username" name="username" placeholder="username"> <br>
        <?php if (isset($_POST['username']) && $_POST['username'] != ''): ?>
        <p class="message"><?=$validation->getUsernameError()?></p>
        <?php endif; ?>
        <?php if (isset($_POST['username']) && $_POST['username'] == '') : ?>
        <p class="message">username cannot be empty</p>
        <?php endif; ?>
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="password"/> <br>
        <?php if (isset($_POST['password']) && $_POST['password'] != ''): ?>
        <p class="message"><?=$validation->getPasswordError()?></p>
        <?php endif; ?>
        <?php if (isset($_POST['password']) && $_POST['password'] == '') : ?>
        <p class="message">password cannot be empty</p>
        <?php endif; ?>
        <span class="small"> Password must contain at least one number and a special character</span>
       
      </div>
      <div>
        <input type="text" id="email" name="email" placeholder="email address"/> <br>
        <?php if (isset($_POST['email']) && $_POST['email'] != ''): ?>
        <p class="message"><?=$validation->getEmailError()?></p>
        <?php endif; ?>
        <?php if (isset($_POST['email']) && $_POST['email'] == '') : ?>
        <p class="message">email cannot be empty</p>
        <?php endif; ?>
      </div>
      <input type="submit" value="Create">
      <p class="message">Already registered? <a href="Login.php">Sign In</a></p>
    </form>
  </div>
</div>
</body>
</html>