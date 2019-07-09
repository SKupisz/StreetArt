<?php
if(!isset($_SESSION["signed_up"]))
{
  header("Location: ../../");
  exit();
}
$connect = require_once "../../src/mainComponents/connect.php";
$isConnect = 1;
try {
  $connection = new mysqli($connect["host"],$connect["db_user"],
$connect["db_password"],$connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $name = $_SESSION['signed_up'];
    $highest = $connection->query("SELECT MAX(views),name FROM slides WHERE fromm = '$name'");
    if(!$highest) throw new Exception($connection->error);
    $highestLiked = $connection->query("SELECT MAX(likes),name FROM slides WHERE fromm = '$name'");
    if(!$highestLiked) throw new Exception($connection->error);
    $nameOfTable = $name."_showing";
    $nameOfLiking = $name."_liking";
    $stats = $connection->query("SELECT * FROM $nameOfTable ORDER BY date DESC");
    if(!$stats) throw new Exception($connection->error);
    $likes = $connection->query("SELECT * FROM $nameOfLiking ORDER BY date DESC");
    if(!$likes) throw new Exception($connection->error);
    $dates = array();
    $views = array();
    $likesTable = array();
    if($likes->num_rows >= 5 && $stats->num_rows >=5)
    {
      for($i = 0 ; $i < 5; $i++)
      {
        $statsRow = $stats->fetch_assoc();
        $likesRow = $likes->fetch_assoc();
        $dates[$i] = $statsRow["date"];
        $views[$i] = $statsRow["quantity"];
        $likesTable[$i] = $likesRow["quantity"];
      }
      $dates = array_reverse($dates);
      $views = array_reverse($views);
      $likesTable = array_reverse($likesTable);
    }


    $row = $highest->fetch_assoc();
    $theHighest = $row["MAX(views)"];
    $theHighestName = $row["name"];

    $likeRow = $highestLiked->fetch_assoc();
    $theHighestLiked = $likeRow["MAX(likes)"];
    $theHighestLikedName = $likeRow["name"];
  }
} catch(Exception $e){
  $isConnect = 0;
}
?>
