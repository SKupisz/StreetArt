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
    <link rel = "stylesheet" href = "../src/forgot/main.css"/>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "signing-content">
        <header class = "main-header">
            Password recovery
        </header>
        <section class = "reset-form">
            <form method = "post" action = "../src/forgot/rescue/sendingEmail.php">
                <div class="small-describe">Write your email below, and we will send you an email with a reset link</div>
                <input type = "email" class = "reseting-input" name = "email" required placeholder = "Your email here..."/>
                <?php if(isset($_SESSION["email-reset-fail"])){
                  ?><div class = "failure"><?php echo $_SESSION["email-reset-fail"]; ?></div><?php
                }
                unset($_SESSION["email-reset-fail"]);
                ?>
                <div class = "button-wrapper">
                    <button type = "submit" class = "reseting-submitBtn">Reset password</button>
                </div>
            </form>
        </section>
    </section>
  </body>
  <script src = "../src/mainSite/js/responsiveNav.js"></script>
</html>
