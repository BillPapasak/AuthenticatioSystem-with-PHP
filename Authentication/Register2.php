
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="./design.css">
</head>
<body>

<h1>Create Your Account</h1>
<?php

require_once("UsersControler.php");
if (!(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email']))) {
    UsersControler::register();
}
else {
    session_destroy();  
}
?>

<div class="container">
  <div class="form">
    <form action="Register2.php" method = "POST">
      <div>
        <input type="text" id="username" name="username" placeholder="username"> <br>
        <?php if (isset($_SESSION['usernameError'])): ?>
        <span class="message"><?=$_SESSION['usernameError']?></span>
        <?php endif; ?>
        <?php if (isset($_POST['authorization'])) : ?>
        <span class="message"><?=$authorization->getUsernameError()?></span>
        <?php endif; ?>
        <?php if (isset($_POST['username']) && $_POST['username'] == '') : ?>
        <span class="message">username cannot be empty</span>
        <?php endif; ?>
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="password"/> <br>
        <?php if (isset($_SESSION['passwordError'])): ?>
        <span class="message"><?=$_SESSION['passwordError']?></span>
        <?php endif; ?>
        <?php if (isset($_POST['authorization'])) : ?>
        <span class="message"><?=$authorization->getPasswordError()?></span>
        <?php endif; ?>
        <?php if (isset($_POST['password']) && $_POST['password'] == '') : ?>
        <span class="message">password cannot be empty</span>
        <?php endif; ?>
        <p class="small"> Password must contain at least one number and a special character</p>
       
      </div>
      <div>
        <input type="text" id="email" name="email" placeholder="email address"/> <br>
        <?php if (isset($_SESSION['emailError'])): ?>
        <span class="message"><?=$_SESSION['emailError']?></span>
        <?php endif; ?>
        <?php if (isset($_POST['authorization'])) : ?>
        <span class="message"><?=$authorization->getEmailError()?></span>
        <?php endif; ?>
        <?php if (isset($_POST['email']) && $_POST['email'] == '') : ?>
        <span class="message">email cannot be empty</span>
        <?php endif; ?>
      </div>
      <input type="submit" value="Create"/>
      <p class="message">Already registered? <a href="Login.php">Sign In</a></p>
    </form>
  </div>
</div>
</body>
</html>
