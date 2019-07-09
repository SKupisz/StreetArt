<?php
session_start();
if(!isset($_POST['albumName']))
{
  header("Location: ../../");
  exit();
}
$forSearch = $_POST["albumName"];
$connect = require_once "./connect.php";
try {
  $connection = new mysqli($connect["host"],$connect["db_user"],
  $connect["db_password"],$connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $firstSearching = $connection->query("SELECT * FROM slides WHERE name LIKE '%$forSearch%'");
    if(!$firstSearching) throw new Exception($connection->error);
    $userSearching = $connection->query("SELECT * FROM users WHERE nickname LIKE '%$forSearch%'");
    if(!$userSearching) throw new Exception($connection->error);
    $firstForSend = Array();
    $userForSend = Array();
    for($i = 0 ; $i < $firstSearching->num_rows; $i++)
    {
      $firstForSend[$i] = $firstSearching->fetch_assoc();
    }
    for($i = 0 ; $i < $userSearching->num_rows; $i++)
    {
      $userForSend[$i] = $userSearching->fetch_assoc();
    }
    $_SESSION['firstData'] = $firstForSend;
    $_SESSION['userData'] = $userForSend;
    header("Location: ../../search/");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['search-error'] = "Sorry, something went wrong. Try later";
  header("Location: ../../");
  exit();
}

?>
