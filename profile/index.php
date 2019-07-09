<?php
require_once "../src/signing/cookie.php";
require_once "../src/profile/logic/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "../src/profile/css/main.css"/>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "main-content">
    <header class = "main-header">
      <?php echo $_SESSION['signed_up'];?>
    </header>
    <section class = "main-info prof-info-display">
      <div class = "info-item">
        E-mail address: <?php echo $email;?>
      </div>
      <?php
      if(strlen($website) > 0)
      {
        ?>
        <div class = "info-item">
          Website: <a href = "<?php echo $website;?>" class = "info-webLink" target="_blank"><?php echo $website;?></a>
        </div>
        <?php
      }
      ?>
      <div class = "info-item">
        Published folders: <?php echo $quantityOfSlides;?>
      </div>
      <?php
      if(isset($_SESSION['update_error']))
      {
        ?><div class = "error"><?php echo $_SESSION['update_error'];?></div><?php
        unset($_SESSION['update_error']);
      }
      ?>
      <button class = "prof-changeMode info-change">
        Edit
      </button>
    </section>
    <section class = "edit-info prof-info-edit">
      <form method="post" action = "../src/profile/logic/saveProfile.php">
      <div class = "info-item">
        <input type = "email" name = "email" class = "edit-infoInput" value = "<?php echo $email;?>" required placeholder="Your email here"/>
      </div>
      <div class = "info-item">
        <input type = "text" name = "website" class = "edit-infoInput" value = "<?php echo $website;?>" placeholder="Your website link here"/>
      </div>
      <button type="submit" class = "prof-changeMode">
        Save
      </button>
      <button type="reset" class = "prof-changeMode doNotSave">
        Back
      </button>
    </form>
    </section>
    <section class = "main-info describe-info">
      <section class = "profileDesc-wrapper">
        <?php echo $profileDescribe; ?>
      </section>
      <?php
      if(isset($_SESSION['profile_error']))
      {
        ?><div class = "error"><?php echo $_SESSION['profile_error'];?></div><?php
        unset($_SESSION['profile_error']);
      }
      ?>
      <button class = "prof-changeMode desc-change">
        Edit
      </button>
    </section>
    <section class = "edit-info desc-edit-info">
      <form method="post" action = "../src/profile/logic/saveDesc.php">
      <div class = "info-item">
        <textarea name = "desc-newContent" class = "desc-Textarea" placeholder="Describe yourself here"><?php echo $forDescUpdate;?></textarea>
      </div>
      <button type="submit" class = "desc-changeMode">
        Save
      </button>
      <button type="reset" class = "desc-changeMode doNotSaveDesc">
        Back
      </button>
    </form>
    </section>
  </section>
  <section class = "main-content published-folders">
    <section class = "slides-wrapper">
      <header class = "slides-header">
        Popular slides
      </header>
      <section class = "slides-mainContent">
    <?php
    for($i = 0; $i < $stopper; $i++)
    {
      $nameNow = $names[$i];
      $addNow = $addresses[$i];
      $addTable = explode("/",$addNow);
      $href = "../show/?u=".$addTable[1]."&n=".$addTable[2];
      ?>
      <a href = "<?php echo $href;?>" target="_blank">
      <div class = "one-slide">
            <header class = "slide-title">
              <?php echo $nameNow; ?>
            </header>
          </div>
        </a><?php
    }
    ?>
  </section>
  </section>
  </section>
  </body>
  <script src = "../src/profile/main.js"></script>
</html>
