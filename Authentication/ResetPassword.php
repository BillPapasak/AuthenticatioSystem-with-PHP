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
if (!(empty($_POST['email']) && empty($_POST['password']) && empty($_POST['confirmPassword']))) {
    UsersControler::resetPassword();
  }
  else {
    session_destroy();
  }
?>

<div class="login-page">
  <div class="form">
    <form class="login-form" action="ResetPassword.php" method="POST">
      <div>
       <?php if (isset($_SESSION['email'])): ?>
          <input type="text" name="email" placeholder="Insert your email" value = <?=stripslashes($_SESSION['email'])?>></br>
        <?php endif; ?>
        <?php if (!isset($_SESSION['email'])): ?>
          <input type="text" name="email" placeholder="Insert your email" /></br>
        <?php endif; ?>
        <?php if (isset($_SESSION['emailError'])): ?>
          <span class="message"><?=$_SESSION['emailError']?></span>
        <?php endif; ?>
        <?php if (isset($_SESSION['emError'])): ?>
          <span class="message"><?=$_SESSION['emError']?></span>
        <?php endif; ?>
        <?php if (isset($_POST['email']) && $_POST['email'] == ''): ?>
          <span class="message">Enter your email</span>
        <?php endif; ?>
      </div>
      <div>
        <input type="password" name="password" placeholder="password"/></br>
        <?php if (isset($_SESSION['passwordError'])) : ?>
          <span class="message"><?=$_SESSION['passwordError']?></span>
        <?php endif; ?>
      </div>
      <div>
        <input type="password" name="confirmPassword" placeholder="confirmPassword"/></br>
        <?php if (isset($_SESSION['confirmationPassError'])) : ?>
          <span class="message"><?=$_SESSION['confirmationPassError']?></span>
        <?php endif; ?>
        <?php if (isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != $_POST['password']) : ?>
          <span class="message">passwords dont match</span>
        <?php endif; ?>
      </div>
      <button>Confirm</button>
      <p class="message">Not registered? <a href="Register2.php">Create an account</a></p>
    </form>
  </div>
</div>
</body>
</html>