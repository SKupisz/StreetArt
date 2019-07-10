<?php
session_start();
if(!isset($_SESSION['signed_up']))
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
  </head>
  <body>
    <?php require_once "../../src/profile/logic/navSupport.php";?>
    <section class = "main-content">
      <?php
      if(isset($_SESSION['slide_error']))
      {
        ?><div class = "error"><?php echo $_SESSION['slide_error'];?></div><?php
        unset($_SESSION['slide_error']);
      }
      ?>
      <header class = "main-header">
        New location
      </header>
      <form method="post" action = "../../src/profile/logic/uploadSlides.php" enctype="multipart/form-data">
      <section class = "howManyForStart">

        <div class = "startInput-container">
          How many slides? <input type = "number" value = "1" min = "1" class = "forStart-quantity" name = "quantity" required/>
        </div>
        <div class = "wrapper">
        <input type="text" class = "slideName" required placeholder="Slideshow name" name = "slideshowName"/>
      </div>
        <button type="button" class = "forStart-submit">
          Create
        </button>
      </section>
      <section class = "form-container">
        <section class = "slides-container">
        </section>
        <button class = 'images-Submit' type = 'submit' name = "submitConfirm">Create slideshow</button>
      </section>

      </form>
    </section>
  </body>
  <script src = "../../src/profile/create.js"></script>
</html>
