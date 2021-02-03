<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
<?php
require_once("UsersControler.php");
if (!(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email']))) {
    UsersControler::login();
  }
  else
    session_destroy();

?>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="Login.php" method="POST">
      <input type="text" name="username" placeholder="username"/></br>
      <?php if (isset($_SESSION['usernameError'])): ?>
        <p class="message"><?= $_SESSION['usernameError']?></p>
      <?php endif; ?>
      <?php if (isset($_POST['username']) && $_POST['username'] == '') : ?>
        <p class="message">Insert your username</p>
      <?php endif; ?>
      <input type="password" name="password" placeholder="password"/></br>
      <?php if (isset($_SESSION['passwordError'])) : ?>
        <p class="message"><?=$_SESSION['passwordError']?></p>
      <?php endif; ?>
      <?php if (isset($_POST['password']) && $_POST['password'] == '') : ?>
        <p class="message">Insert your password</p>
      <?php endif; ?>
      <button>login</button>
      <p class="message">Not registered? <a href="Register2.php">Create an account</a></p>
      <p class="message">Forgot password? <a href="ResetPassword.php">Reset your password</a></p>
    </form>
  </div>
</div>
</body>
</html>