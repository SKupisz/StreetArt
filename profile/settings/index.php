<?php
require_once "../../src/signing/cookie.php";
require_once "../../src/profile/settings/logic/loadData.php";
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StreetArt</title>
    <link rel = "stylesheet" href = "../../src/profile/settings/css/main.css"/>
  </head>
  <body>
    <?php require_once "../../src/profile/logic/navSupport.php";?>
    <section class = "main-content">
        <header class = "welcome-header">
            Account settings
        </header>
        <section class = "user-data">
          <header class = "section-header">
            Basic data
          </header>
          <section class = "data-container">
            <div class = "userData-item nickname">Nickname: <?php echo $name;?></div>
            <div class = "userData-item email">Email: <?php echo $email;?></div>
            <div class = "userData-item website">Website: <a href = "<?php echo $website;?>" target = "_blank"><?php echo $website;?></a></div>
          </section>
        </section>
        <section class = "account-settings">
        <header class = "section-header">
          Change your password
        </header>
        <form method = "post" action = "../../src/profile/settings/logic/changePass.php">
        <section class = "password-inputs">
          <input type = "password" name = "newpass" class = "accountSettings-input" <?php if($fail == 1){?>value = "<?php echo $_SESSION['fail-table'][0];?>"<?php }?> required placeholder = "New password"/>
          <input type = "password" name = "newrep" class = "accountSettings-input" <?php if($fail == 1){?>value = "<?php echo $_SESSION['fail-table'][0];?>"<?php }?> required placeholder = "Repeat password"/>
          <?php if(isset($_SESSION["not-this-password"]))
          {
            ?><div class = "error"><?php echo $_SESSION["not-this-password"]; 
            unset($_SESSION["not-this-password"]);
            unset($_SESSION['fail-table']);?></div><?php
          }
          else if(isset($_SESSION["password-changed"])){
            ?><div class = "success">
              <?php echo $_SESSION["password-changed"]; 
              unset($_SESSION["password-changed"]);?>
            </div>
            <?php
          }?>
        </section>
        <div class = "button-container">
          <button class = "changePass-btn" type = "submit">Change password</button>
        </div>
        </form>
        </section>
      <section class = "dangerous-one">
        <header class = "section-header">
          Danger zone
        </header>
        <section class = "ownership">
        </section>
        <section class = "clear">
        <header class = "subheader">
            Clear my account
        </header>
        <p class = "subsection-desc">
          Your slides will be deleted, and your stats will be reset
        </p>
        <form method = "post" action = "../../src/profile/settings/vanishAccount.php" class = "sending">
        <button class = "dangersection-btn" name = "delete" type = "submit">Reset</button>
        </form>        
      </section>
        <section class = "drop">
          <header class = "subheader">
            Delete my account
        </header>
        <p class = "subsection-desc">
          Your account data will be completly deleted
        </p>
        <form method = "post" action = "../../src/profile/settings/deleteAccount.php" class = "sending">
        <button class = "dangersection-btn" name = "delete" type = "submit">Delete</button>
        </form>
        </section>
      </section>
    </section>
  </body>
</html>
