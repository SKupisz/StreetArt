<?php
require_once "../src/signing/cookie.php";
require_once "../src/user/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
    <link rel = "stylesheet" href = "../src/profile/css/main.css"/>
    <style>
    .failed{
      position: relative;
      top: 67px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
      font-size: 2em;
      font-family: 'Oswald',sans-serif;
      color: white;
    }
    </style>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "main-content">
      <?php
      if($ifConnected == 1)
      {
        ?>
        <header class = "main-header">
          <?php echo $_GET["n"]?>
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
          <a href = "<?php echo $href;?>" target="blank">
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
      </section><?php
      }
      else if($ifConnected == 2)
      {
        ?>
        <div class = "failed">
        This user does not exist
        </div></section><?php
      }
      else {
        ?>
        <div class = "failed">
        Something went wrong. Try later
        </div></section><?php
      }
      ?>
  </body>
  <script src = "../src/mainSite/js/responsiveNav.js"></script>
</html>
