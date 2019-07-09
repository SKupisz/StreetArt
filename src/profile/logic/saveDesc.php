<?php
session_start();
if(!isset($_SESSION['signed_up']))
{
  header("Location: ../../../");
  exit();
}
if(!(isset($_POST['desc-newContent'])))
{
  $newDesc = "No description";
}
else {
  $newDesc = $_POST['desc-newContent'];
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
    $forId = $connection->query("SELECT id FROM users WHERE nickname = '$name'");
    if(!$forId) throw new Exception($connection->error);
    $forIdRow = $forId->fetch_assoc();
    $id = $forIdRow['id'];
    $newDesc = htmlentities($newDesc,ENT_QUOTES,"UTF-8");
    $newDesc = htmlspecialchars($newDesc);
    $sql = "UPDATE users SET profileDesc = '$newDesc' WHERE id = 1";
    $updateDesc = $connection->query($sql);
    if(!$updateDesc) throw new Exception($connection->error);
    mysqli_close($connection);
    header("Location: ../../../profile");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['profile_error'] = $e->getMessage();
  $_SESSION['profile_return'] = $newDesc;
  header("Location: ../../../profile");
  exit();
}
