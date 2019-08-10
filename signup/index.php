<?php
require_once "../src/signing/cookie.php";
if(isset($_SESSION['signed_up']))
{
  header("Location: ../");
  exit();
}
if(isset($_SESSION['backData']))
{
  $backData = $_SESSION['backData'];
  $login = $backData[0];
  $email = $backData[1];
  $pass = $backData[2];
  $passrep = $backData[3];
}
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
    <link rel = "stylesheet" href = "../src/signing/in/main.css"/>
    <link rel = "stylesheet" href = "../src/signing/up/main.css"/>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "signing-content">
      <header class = "main-header">
        SIGN UP
      </header>
      <form method="post" class = "signing-mainContent" action = "../src/signing/up/authorize.php">
        <input type = "text" class = "signing-input" name = "login" required placeholder="Login"
        <?php if(isset($login)){echo "value='".$login."'";} ?>/>
        <?php if(isset($_SESSION['signup_login_error'])) {?><div class = "error"><?php echo $_SESSION['signup_login_error'];?></div><?php }?>
        <input type = "email" class = "signing-input" name = "email" required placeholder="E-mail address"
        <?php if(isset($email)){echo "value='".$email."'";} ?>/>
        <?php if(isset($_SESSION['signup_email_error'])) {?><div class = "error"><?php echo $_SESSION['signup_email_error'];?></div><?php }?>
        <input type = "password" class = "signing-input" name = "password" required placeholder="Password"
        <?php if(isset($pass)){echo "value='".$pass."'";} ?>/>
        <?php if(isset($_SESSION['signup_pass_error'])) {?><div class = "error"><?php echo $_SESSION['signup_pass_error'];?></div><?php }?>
        <input type = "password" class = "signing-input" name = "passwordrep" required placeholder="Repeat password"
        <?php if(isset($passrep)){echo "value='".$passrep."'";} ?>/>
        <?php if(isset($_SESSION['signup_passrep_error'])) {?><div class = "error"><?php echo $_SESSION['signup_passrep_error'];?></div><?php }?>
          <?php if(isset($_SESSION['signup_error'])) {?><div class = "error"><?php echo $_SESSION['signup_error'];?></div><?php }?>
        <button class = "signing-submitBtn" type="submit">
          Sign in
        </button>
      </form>
    </section>
  </body>
  <?php
  unset($_SESSION['backData']);
  unset($_SESSION['signup_login_error']);
  unset($_SESSION['signup_email_error']);
  unset($_SESSION['signup_pass_error']);
  unset($_SESSION['signup_passrep_error']);
  unset($_SESSION['signup_error']);
  ?>
  <script src = "../src/mainSite/js/responsiveNav.js"></script>
</html>
