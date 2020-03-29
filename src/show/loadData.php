<?php

if(!isset($_GET['u']) || !isset($_GET['n']))
{
  header("Location: ../");
  exit();
}
$username = $_GET['u'];
$name = $_GET['n'];
$connect = require_once "../src/mainComponents/connect.php";
$isConnect = 1;
try {
  $connection = new mysqli($connect["host"],$connect["db_user"],
$connect["db_password"],$connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $username = htmlentities($username);
    $forMakeSure = $connection->query("SELECT * FROM slides WHERE fromm = '$username' AND name = '$name'");
    if(!$forMakeSure) throw new Exception($connection->error);
    if($forMakeSure->num_rows == 0)
    {
      $isConnect = -1;
    }
    else {
      $toGetAddress = $forMakeSure->fetch_assoc();
      $address = "../".$toGetAddress["address"];
      $files = scandir($address,SCANDIR_SORT_DESCENDING);
      $files = array_reverse($files);
      $addresses = Array();
      for($i = 2 ; $i < count($files); $i++)
      {
        $toConnect = $files[$i];
        $addresses[$i-2] = $address."/".$toConnect;
      }
      $id = $toGetAddress["id"];
      $increment = $connection->query("UPDATE slides SET views = views + 1 WHERE id = $id");
      if(!$increment) throw new Exception($connection->error);
      $nameOfTable = $username."_showing";
      $date = date("Y/m/d");
      $doesUserExist = $connection->query("SHOW TABLES LIKE '$nameOfTable'");
      if(!$doesUserExist) throw new Exception($connection->error);
      if($doesUserExist->num_rows != 0)
      {
        $forCheck = $connection->query("SELECT * FROM $nameOfTable WHERE date = '$date'");
        if(!$forCheck) throw new Exception($connection->error);
        if($forCheck->num_rows == 0){
          
          $insert = $connection->query("INSERT INTO $nameOfTable VALUES (NULL,'$date',1)");
          if(!$insert) throw new Exception($connection->error);
        }
        else
        {
          $update = $connection->query("UPDATE $nameOfTable SET quantity = quantity + 1 WHERE date = '$date'");
          if(!$update) throw new Exception($connection->error);
        }
      }
      $signedUser = $_SESSION["signed_up"];
      $checkIfLiked = $connection->query("SELECT * FROM sent_likes WHERE fromm = '$signedUser' and forWhichSlide = $id");
      if(!$checkIfLiked) throw new Exception($connection->error);
      if($checkIfLiked->num_rows == 0)
      {
        $liked = 0;
      }
      else
      {
        $liked = 1;
      }
    }
  }
} catch (Exception $e) {
  $isConnect = 0;
  echo $e->getMessage();
}
$cookieName = $name."_liked";
?>
