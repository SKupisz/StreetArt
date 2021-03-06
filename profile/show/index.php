<?php
require_once "../../src/signing/cookie.php";
require_once "../../src/profile/show/logic/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "../../src/profile/show/css/main.css"/>
    <link rel="shortcut icon" type = "image/png" href = "../../src/imgForDecoration/logo.png"/>
  </head>
  <body onload = "loadChart()">
  <?php require_once "../../src/profile/logic/navSupport.php";?>
    <section class = "main-content">
      <header class = "welcome-header">
      <?php if($isConnect == 1)
      {
        ?>Your stats<?php
      }
      else
      {
        ?>Something went wrong. Try later<?php
      }?>
        
      </header>
      <?php if($isConnect == 1)
      {
        ?>
      <main class = "stats-container">
      <div class = "highest-views">The highest-viewed slideshow: <?php echo $theHighestName;?> (<?php echo $theHighest; 
      if($theHighest == 1){?> view<?php }else{?> views<?php }?>)</div>
      <div class = "highest-liked">The highest-liked slideshow: <?php echo $theHighestLikedName;?> (<?php echo $theHighestLiked; 
      if($theHighestLiked == 1){?> like<?php }else{?> likes<?php }?>)</div>
      <div class = "totals total-views">Total views</div>
      <section class = "totalViews-stats">
        <?php
          if(count($dates) < 5)
          {
            ?><div class = "not-enough-data">Sorry, but we don't have enough data to show statistics now. Come back in <?php echo 5-count($dates);?> days</div><?php 
          }
          else
          {?><section class = "stats-wrapper"><?php
            for($i =  0; $i < 5; $i++)
            {
              $quantity = $views[$i];
              $date = $dates[$i];
              ?><div class = "stats-column column<?php echo $i+1;?>" id = "column<?php echo $quantity;?>" v-bind:title="message">
              <?php echo $quantity;?>
              <div class = "margin-top">
              </div>
              <div class = "quantity-showing"><?php echo $date; ?></div>
              </div><?php
            }
            ?></section>
                    <section class = "average-section average-views">
        Average views: <?php echo $avgViews; ?>
        </section><?php
          }

        ?>
      </section>
      <div class = "totals total-likes">Total likes</div>
      <section class = "totalViews-stats">
        <?php
          if(count($dates) < 5)
          {
            ?><div class = "not-enough-data">Sorry, but we don't have enough data to show statistics now. Come back in <?php echo 5-count($dates);?> days</div><?php 
          }
          else
          {?><section class = "stats-wrapper"><?php
            for($i = 0 ; $i < 5; $i++)
            {
              $quantity = $likesTable[$i];
              $date = $dates[$i];
              ?><div class = "stats-column column<?php echo $i+6;?>" id = "column<?php echo $quantity;?>" v-bind:title="message">
              <?php echo $quantity;?>
              <div class = "margin-top"></div>
              <div class = "quantity-showing"><?php echo $date; ?></div>
              </div><?php
            }
            ?></section>
                                <section class = "average-section average-likes">
        Average likes: <?php echo $avgLikes; ?>
        </section><?php
          }

        ?>
      </section>

      </main>
        <?php
      }?>

    </section>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script src = "../../src/profile/show/js/main.js"></script>
  <script src = "../../src/mainSite/js/responsiveNav.js"></script>
</html>
