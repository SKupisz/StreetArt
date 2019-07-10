<?php
require_once "../src/signing/cookie.php";
require_once "../src/show/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "../src/show/main.css"/>
  </head>
  <body onload = "readRows()">
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "main-content">
      <?php
      if($isConnect == 1)
      {
        for($i = 0 ; $i < count($addresses); $i++)
        {
          $nowImg = $addresses[$i];
          ?>
          <figure class = "slide-container slide<?php echo $i;?>">
            <img src = "<?php echo $nowImg;?>" class = "slide-picture"/>
          </figure><?php
        }
        ?>
        <section class = "star-container">
          <div class = "star-wrapper">
          <?php 
          if(isset($_COOKIE[$cookieName]) || $liked == 1) {
           ?> <img src = "../src/imgForDecoration/star.png" class = "star-img" onclick = "likeThisSlide('<?php echo $_GET['n'];?>');"/><?php    
          }
          else {
            ?> <img src = "../src/imgForDecoration/non-star.png" class = "star-img" onclick = "likeThisSlide('<?php echo $_GET['n'];?>');"/><?php
          }
          ?>
         
      </div>
        </section>
        <?php
      }
      else
      {
        ?>Fail<?php
      }

      ?>

    </section>
  </body>
  <script src = "../src/show/main.js"></script>
</html>
