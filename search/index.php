<?php
require_once "../src/searcher/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
    <link rel = "stylesheet" href = "../src/searcher/css/main.css"/>
  </head>
  <body>
    <?php require_once "../src/mainComponents/nav.php";?>
    <section class = "main-content">
      <?php
      if($part == 2)
      {
        ?>
        <form method = "post" action = "../src/mainComponents/searcher.php">
          <input type = "text" name = "albumName" class = "albumName-inputPart" required placeholder="Album name here"/>
          <div class = "input-wrapper">
          <button class = "albumName-submitBtnPart" type="submit">
            Search
          </button>
        </div>
        </form>
        <?php
      }
      else {
        ?>
        <section class = "search-menu">
          <button class = "search-menuItem slidesBtn">
            Slides
          </button>
          <button class = "search-menuItem usersBtn">
            Users
          </button>
        </section>
        <section class = "showing-results">
          <section class = "resultsSlides">
            <?php
              if(count($firstTable) > 0){
                for($i = 0 ; $i < count($firstTable); $i++)
                {
                  $forNow = $firstTable[$i];
                  $nameForNow = $forNow["name"];
                  $creatorForNow = $forNow["fromm"];
                  $forAddress = $forNow["address"];
                  $forAddressExploded = explode("/",$forAddress);
                  $href = "../show/?u=".$forAddressExploded[1]."&n=".$forAddressExploded[2];
                  ?>
                  <a href = "<?php echo $href;?>" target="_blank">
                  <div class = "resultsRow slides-row">
                    <header class = "resultsRow-title"><?php echo $nameForNow;?></header>
                    <footer class = "resultsRow-user">By <?php echo $creatorForNow;?></footer>
                  </div>
                </a><?php
                }
              }
              else
              {
                ?>
                <div class = "resultsRow slides-row">
                  <header class = "noResultHeader">Sorry</header>
                  We couldn't find anything in the slides section matching your target.
                </div>
                <?php
              }

            ?>
          </section>
          <section class = "resultsUsers">
            <?php
            if(count($userTable) > 0)
            {
              for($i = 0 ; $i < count($userTable); $i++)
              {
                $forNow = $userTable[$i];
                $nameForNow = $forNow["nickname"];
                $profDescNow = $forNow["profileDesc"];
                $profDescNow = htmlspecialchars_decode($profDescNow,ENT_QUOTES);
                if(strlen($profDescNow) > 100)
                {
                  $profDescNow = substr($profDescNow,0,98)."...";
                }
                $href = "../user/?n=".$nameForNow;
                ?>
                <a href = "<?php echo $href;?>" target="_blank">
                <div class = "resultsRow slides-row">
                  <header class = "resultsRow-title"><?php echo $nameForNow;?></header>
                  <footer class = "resultsRow-desc"><?php echo $profDescNow;?></footer>
                </div>
              </a><?php
              }
            }
            else {
              ?>
              <div class = "resultsRow users-row">
                <header class = "noResultHeader">Sorry</header>
                We couldn't find anything in the users section matching your target.
              </div>
              <?php
            }

            ?>
          </section>
        </section>
        <?php
      }
      ?>
    </section>
  </body>
  <script src = "../src/searcher/main.js"></script>
  <script src = "../src/mainSite/js/responsiveNav.js"></script>
</html>
