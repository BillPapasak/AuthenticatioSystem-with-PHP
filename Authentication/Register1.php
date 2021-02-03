
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design.css">
</head>
<body>
<?php

require_once("UsersControler.php");
if (!(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email']))) 
  UsersControler::register();
?>

<div class="container">
  <div class="form">
    <form class="register-form" action="Register1.php" method = "POST">
      <div>
        <input type="text" id="username" name="username" placeholder="username"> <br>
        <?php if (isset($_GET['usernameError'])): ?>
        <p class="message"><?=$_GET['usernameError']?></p>
        <?php endif; ?>
        <?php if (isset($_POST['authorization'])) : ?>
        <p class="message"><?=$authorization->getUsernameError()?></p>
        <?php endif; ?>
        <?php if (isset($_POST['username']) && $_POST['username'] == '') : ?>
        <p class="message">username cannot be empty</p>
        <?php endif; ?>
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="password"/> <br>
        <?php if (isset($_GET['passwordError'])): ?>
        <p class="message"><?=$_GET['passwordError']?></p>
        <?php endif; ?>
        <?php if (isset($_POST['authorization'])) : ?>
        <p class="message"><?=$authorization->getPasswordError()?></p>
        <?php endif; ?>
        <?php if (isset($_POST['password']) && $_POST['password'] == '') : ?>
        <p class="message">password cannot be empty</p>
        <?php endif; ?>
        <span class="small"> Password must contain at least one number and a special character</span>
       
      </div>
      <div>
        <input type="text" id="email" name="email" placeholder="email address"/> <br>
        <?php if (isset($_GET['emailError'])): ?>
        <p class="message"><?=$_GET['emailError']?></p>
        <?php endif; ?>
        <?php if (isset($_POST['authorization'])) : ?>
        <p class="message"><?=$authorization->getEmailError()?></p>
        <?php endif; ?>
        <?php if (isset($_POST['email']) && $_POST['email'] == '') : ?>
        <p class="message">email cannot be empty</p>
        <?php endif; ?>
      </div>
      <input type="submit" value="Create"/>
      <p class="message">Already registered? <a href="Login.php">Sign In</a></p>
    </form>
  </div>
</div>
</body>
</html>
