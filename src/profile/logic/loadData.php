<?php
if(!isset($_SESSION['signed_up']))
{
  header("Location: ../");
  exit();
}
$connect = require_once "../src/mainComponents/connect.php";
$ifConnected = 1;
try {
  $connection = new mysqli($connect["host"],$connect["db_user"],
$connect["db_password"],$connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $name = $_SESSION['signed_up'];
    $userData = $connection->query("SELECT * FROM users WHERE nickname = '$name'");
    if(!$userData) throw new Exception($connection->error);
    $userDataRow = $userData->fetch_assoc();
    $email = $userDataRow["email"];
    $profileDescribe = $userDataRow["profileDesc"];
    $profileDescribe = htmlspecialchars_decode($profileDescribe);
    $profileDescribe = html_entity_decode($profileDescribe,ENT_QUOTES,"UTF-8");
    if(isset($_SESSION['profile_return']))
    {
      $forDescUpdate = $_SESSION['profile_return'];
      $forDescUpdate = htmlspecialchars_decode($forDescUpdate);
      $forDescUpdate = html_entity_decode($forDescUpdate,ENT_QUOTES,"UTF-8");
      unset($_SESSION['profile_return']);
    }
    else {
      $forDescUpdate = $profileDescribe;
    }
    $website = $userDataRow['website'];
    $mostPopular = $connection->query("SELECT * FROM slides WHERE fromm = '$name' ORDER BY likes LIMIT 3");
    if(!$mostPopular) throw new Exception($connection->error);
    $names = Array();
    $addresses = Array();
    $quantityOfSlides = $mostPopular->num_rows;
    if($mostPopular->num_rows < 3)
    {
      $stopper = $mostPopular->num_rows;
    }
    else {
      $stopper = 3;
    }
    for($i = 0 ; $i < $stopper; $i++)
    {
      $localRow = $mostPopular->fetch_assoc();
      $names[$i] = $localRow['name'];
      $addresses[$i] = $localRow["address"];
    }

  }
} catch (Exception $e) {
  $ifConnected = 0;
}

?>
