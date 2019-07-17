<nav class = "main-navbar">
      <a href = "../../">
        <button class = "nav-item mainSite">
          StreetArt
        </button>
      </a>
      <a href = "../../albums/">
        <button class = "nav-item albums">
          Albums
        </button>
      </a>

      <?php
      if(isset($_SESSION['signed_up']))
      {
        ?>
        <a href = "../../src/mainComponents/logout.php">
          <button class = "nav-item signing-in">
            Logout
          </button>
        </a>
        <div class = "nav-item create-dropDown">
          +
          <a href = "../../profile/create">
            <button class = "prof-dropItem create">
              Create
            </button>
          </a>
          <a href = "../../profile/show">
            <button class = "prof-dropItem stats">
              Statistics
            </button>
          </a>
          <a href = "../../profile/settings">
            <button class = "prof-dropItem settings">
              Settings
            </button>
      </a>
        </div>
        <a href = "../../profile/">
          <button class = "nav-item signing-up">
            Your profile
          </button>
        </a>

        <?php
      }
      else {
        ?>
        <a href = "../../signup/">
          <button class = "nav-item signing-up">
            Sign up
          </button>
        </a>
        <a href = "../../signin/">
          <button class = "nav-item signing-in">
            Sign in
          </button>
        </a>
        <?php
      }
      ?>
      <form method="post" action = "../../src/mainComponents/searcher.php" class = "nav-item searcher-container">
        <input type = "text" name = "albumName" class = "albumName-input" required placeholder="Album name here"/>
        <button class = "nav-item albumName-submitBtn" type="submit">
          Search
        </button>
      </form>
    </nav>