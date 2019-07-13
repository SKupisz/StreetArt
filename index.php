<?php
require_once "./src/signing/cookie.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "./src/mainSite/css/main.css"/>
  </head>
  <body>
    <nav class = "main-navbar">
      <a href = "">
        <button class = "nav-item mainSite">
          StreetArt
        </button>
      </a>
      <a href = "albums/">
        <button class = "nav-item albums">
          Albums
        </button>
      </a>

      <?php
      if(isset($_SESSION['signed_up']))
      {
        ?>
        <a href = "src/mainComponents/logout.php">
          <button class = "nav-item signing-in">
            Logout
          </button>
        </a>
        <div class = "nav-item create-dropDown">
          +
          <a href = "profile/create">
            <button class = "prof-dropItem create">
              Create
            </button>
          </a>
          <a href = "profile/show">
            <button class = "prof-dropItem stats">
              Statistics
            </button>
          </a>
          <a href = "profile/settings">
            <button class = "prof-dropItem settings">
              Settings
            </button>
          </a>
        </div>
        <a href = "profile/">
          <button class = "nav-item signing-up">
            Your profile
          </button>
        </a>

        <?php
      }
      else {
        ?>
        <a href = "signup/">
          <button class = "nav-item signing-up">
            Sign up
          </button>
        </a>
        <a href = "signin/">
          <button class = "nav-item signing-in">
            Sign in
          </button>
        </a>
        <?php
      }
      ?>
      <form method="post" action = "src/mainComponents/searcher.php" class = "nav-item searcher-container">
        <input type = "text" name = "albumName" class = "albumName-input" required placeholder="Album name here"/>
        <button class = "nav-item albumName-submitBtn" type="submit">
          Search
        </button>
      </form>
    </nav>

    <section class = "section-container for-welcome">
      <header class = "main-header photos-header">
      WANT TO PUBLISH YOUR PHOTOS?
    </header>
    <header class = "main-header popular-header">
      OR MAKE SOME BEAUTIFUL PLACE MORE FAMOUS?
    </header>
    </section>
    <section class = "section-container describing-page">
      <div class = "describe-content">
        Welcome to StreetArt website. Here, you can share the beauty of the world with another people by making and publishing photos.
      </div>
    </section>
  </body>
</html>
