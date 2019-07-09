<?php
session_start();
if(!isset($_SESSION['signed_up']))
{
  header("Location: ../../../");
  exit();
}
if(!(isset($_POST['email'])))
{
  header("Location: ../../../profile/");
  exit();
}
$email = $_POST['email'];
if(!isset($_POST['website']))
{
  $web = "";
}
else {
  $web = $_POST['website'];
}
$connect = require_once "../../mainComponents/connect.php";
try {
  $connection = new mysqli($connect["host"],$connect["db_user"],
  $connect["db_password"],$connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $name = $_SESSION['signed_up'];
    $updateEmail = $connection->query("UPDATE users SET email = '$email' WHERE nickname = '$name'");
    if(!$updateEmail) throw new Exception($connection->error);
    $updateWeb= $connection->query("UPDATE users SET website = '$web' WHERE nickname = '$name'");
    if(!$updateWeb) throw new Exception($connection->error);
    mysqli_close($connection);
    header("Location: ../../../profile");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['update_error'] = "Sorry, something went wrong. Try later";
  header("Location: ../../../profile");
  exit();
}

?>
