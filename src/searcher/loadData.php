<?php
session_start();
if((!isset($_SESSION['firstData']) || !isset($_SESSION['userData'])) && !isset($_GET["q"])){
  $part = 2;
}
else if(!isset($_SESSION['firstData']) || !isset($_SESSION['userData']))
{
  $forSearch = $_GET["q"];
  $connect = require_once "../src/mainComponents/connect.php";
  $connected = 1;
  try {
    $connection = new mysqli($connect["host"],$connect["db_user"],
    $connect["db_password"],$connect["db_name"]);
    if($connection->connect_errno != 0)
    {
      throw new Exception($connection->connect_error);
    }
    else {
      $username = $_SESSION["signed_up"];
      $firstSearching = $connection->query("SELECT * FROM slides WHERE name = '%$forSearch%'");
      if(!$firstSearching) throw new Exception($connection->error);
      $userSearching = $connection->query("SELECT * FROM users WHERE nickname = '%$username%'");
      if(!$userSearching) throw new Exception($connection->error);
      $firstTable = Array();
      $userTable = Array();
      for($i = 0 ; $i < $firstSearching->num_rows; $i++)
      {
        $firstTable[$i] = $firstSearching->fetch_assoc();
      }
      for($i = 0 ; $i < $userSearching->num_rows; $i++)
      {
        $userTable[$i] = $userSearching->fetch_assoc();
      }
    }
  } catch (Exception $e) {
    $connected = 0;
  }
}
else {
  $part = 1;
  $firstTable = $_SESSION['firstData'];
  $userTable = $_SESSION["userData"];
}
?>
