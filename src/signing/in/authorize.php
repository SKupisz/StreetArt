<?php
session_start();
if(isset($_SESSION['signed_up']))
{
  header("Location: ../../../");
  exit();
}
if(!(isset($_POST['login']) && isset($_POST['password'])))
{
  header("Location: ../../../signup");
  exit();
}
$login = $_POST['login'];
$pass = $_POST['password'];
$login = htmlentities($login);
$connect = require_once "../../mainComponents/connect.php";

try {
  $connection = new mysqli($connect["host"],
  $connect["db_user"],$connect["db_password"],
  $connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $checkThisOut = $connection->query("SELECT * FROM users WHERE nickname = '$login'");
    if(!$checkThisOut) throw new Exception($connection->error);
    if($checkThisOut->num_rows > 0)
    {
      $checkRow = $checkThisOut->fetch_assoc();
      if(password_verify($pass,$checkRow['password']))
      {
        $_SESSION['signed_up'] = $login;
        $value = $login." ".$pass;
        setCookie("signed_up_already",$value,time()+(86400*30),"/");
        header("Location: ../../../");
        exit();
      }
      else {
        $_SESSION['signin_error'] = "Incorrect nickname or password";
        $login = html_entity_decode($login);
        $_SESSION['backData'] = [$login,$pass_reserve];
        header("Location: ../../../signin/");
        exit();
      }
    }
    else {
      $_SESSION['signin_error'] = "Incorrect nickname or password";
      $login = html_entity_decode($login);
      $_SESSION['backData'] = [$login,$pass_reserve];
      header("Location: ../../../signin/");
      exit();
    }
  }
} catch(Exception $e)
{
  $_SESSION['signin_error'] = "Something went wrong. Try later";
  $login = html_entity_decode($login);
  $_SESSION['backData'] = [$login,$pass_reserve];
  header("Location: ../../../signin/");
  exit();
}
?>
