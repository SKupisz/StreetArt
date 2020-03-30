<?php
session_start();
if(!isset($_SESSION['signed_up']) || !isset($_SESSION['uploadDone']))
{
  header("Location: ../../");
  exit();
}
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "../../src/profile/createcss/main.css"/>
    <link rel="shortcut icon" type = "image/png" href = "../../src/imgForDecoration/logo.png"/>
  </head>
  <body>
    <?php require_once "../../src/profile/logic/navSupport.php";?>
    <section class = "main-content">
      <header class = "done-header">
        <?php echo $_SESSION['uploadDone'];
        unset($_SESSION['uploadDone'])?>
      </header>
    </section>
  </body>
  <script src = "../../src/mainSite/js/responsiveNav.js"></script>
</html>
