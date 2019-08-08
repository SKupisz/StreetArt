<?php 
require_once "../src/signing/cookie.php";
if(isset($_SESSION["signed_up"]))
{
  header("Location: ../");
  exit();
}
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
    <link rel = "stylesheet" href = "../src/signing/in/main.css"/>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "signing-content">
      <header class = "main-header">
        SIGN IN
      </header>
      <form method="post" class = "signing-mainContent" action = "../src/signing/in/authorize.php">
        <input type = "text" class = "signing-input" name = "login" required placeholder="Login"/>
        <input type = "password" class = "signing-input" name = "password" required placeholder="Password"/>
        <?php if(isset($_SESSION['signin_error'])) {?><div class = "error"><?php echo $_SESSION['signin_error'];?></div><?php }?>
        <button class = "signing-submitBtn" type="submit">
          Sign in
        </button>
      </form>
    </section>
  </body>
  <script src = "../src/mainSite/js/responsiveNav.js"></script>
</html>
