<?php
require_once "../src/signing/cookie.php";
require_once "../src/albums/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "../src/albums/css/main.css"/>
    <link rel="shortcut icon" type = "image/png" href = "../src/imgForDecoration/logo.png"/>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "main-content">
      <?php
        if($isConnected == 0)
        {
          ?>
          <div class = "failed-connection">
            <header class = "fail-desc">Oooops!...</header>
            <section class = "fail-content">
              Something went wrong. Try later
            </section>
          </div>
          <?php
        }
        else {
          ?>
          <section class = "slides-wrapper">
            <header class = "slides-header">
              Top slides
            </header>
            <section class = "slides-mainContent">
          <?php
          for($i = 0; $i < $howMany; $i++)
          {
            $rowForNow = $rows[$i];
            $hrefBase = $rowForNow["address"];
            $hrefBaseExploded = explode("/",$hrefBase);
            $href = "../show/?u=".$hrefBaseExploded[1]."&n=".$hrefBaseExploded[2];
            $nameNow = $rowForNow["name"];
            ?>
            <a href = "<?php echo $href;?>">
            <div class = "one-slide">
                  <header class = "slide-title">
                    <?php echo $nameNow; ?>
                  </header>
                </div>
              </a>
            <?php
          }
          ?>
        </section>
      </section><?php
        }
      ?>
    </section>
    <?php
      if($howMany > 3)
      {
        for($i = 0 ; $i < $howMany-1; $i++)
        {
          ?>
          <section class = "extender" style = "top: <?php echo ($i+1)*100;?>%;">
          </section>
          <?php
        }
      }
    ?>
  </body>
  <script src = "../src/mainSite/js/responsiveNav.js"></script>
</html>
