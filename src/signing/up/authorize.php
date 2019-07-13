<?php
session_start();
if(isset($_SESSION['signed_up']))
{
  header("Location: ../../../");
  exit();
}
if(!(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordrep']) && isset($_POST['email'])))
{
  header("Location: ../../../signup");
  exit();
}
$login = $_POST['login'];
$email = $_POST['email'];
$pass= $_POST['password'];
$passrep = $_POST['passwordrep'];
$fail = 0;
if(strlen($login) < 5)
{
  $_SESSION['signup_login_error'] = "Your login is too short";
  $fail = 1;
}
$forCheckEmail = explode("@",$email);
if(count($forCheckEmail) != 2)
{
  $_SESSION['signup_email_error'] = "Your email is incorrect";
  $fail = 1;
}
if(strlen($pass) < 8)
{
  $_SESSION['signup_pass_error'] = "Your password must have at least 8 signs";
  $fail = 1;
}
if($passrep != $pass)
{
  $_SESSION['signup_passrep_error'] = "Passwords are not the same";
  $fail = 1;
}
if($fail == 1)
{
  $_SESSION['backData'] = [$login,$email,$pass,$passrep];
  header("Location: ../../../signup");
  exit();
}
else {
  $login = htmlentities($login);
  $email = htmlentities($email);
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
      $ifUser = $connection->query("SELECT * FROM users WHERE nickname = '$login'");
      if(!$ifUser) throw new Exception($connectionn->error);
      if($ifUser->num_rows > 0){
        $_SESSION['signup_error'] = "This nickname is already taken";
        $_SESSION['backData'] = [$login,$email,$pass,$passrep];
        header("Location: ../../../signup");
        exit();
      }
      $ifEmail = $connection->query("SELECT * FROM users WHERE email = '$email'");
      if(!$ifEmail) throw new Exception($connection->error);
      if($ifEmail->num_rows > 0)
      {
        $_SESSION['signup_error'] = "This email is already registered";
        $_SESSION['backData'] = [$login,$email,$pass,$passrep];
        header("Location: ../../../signup");
        exit();
      }
      $pass = password_hash($pass,PASSWORD_DEFAULT);
      $insert = $connection->query("INSERT INTO users VALUES(NULL,'$login','$email','$pass','No direction yet',0,'No describe','')");
      if(!$insert) throw new Exception($connection->error);
      $showing = $login."_showing";
      $sql = "CREATE TABLE $showing ( id INT NOT NULL AUTO_INCREMENT , date TEXT CHARACTER SET
      utf8 COLLATE utf8_polish_ci NOT NULL ,quantity INT NOT NULL,PRIMARY KEY (id)) ENGINE = InnoDB CHARSET=utf8
      COLLATE utf8_polish_ci;";
      $createShowing = $connection->query($sql);
      if(!$createShowing) throw new Exception($connection->error);
      $liking = $login."_liking";
      $sql = "CREATE TABLE $liking ( id INT NOT NULL AUTO_INCREMENT , date TEXT CHARACTER SET
      utf8 COLLATE utf8_polish_ci NOT NULL ,quantity INT NOT NULL,PRIMARY KEY (id)) ENGINE = InnoDB CHARSET=utf8
      COLLATE utf8_polish_ci;";
      $createLiking = $connection->query($sql);
      if(!$createLiking) throw new Exception($connection->error);
      $_SESSION['signed_up'] = $login;
      setCookie("signed_up_already",$value,time()+(86400*30),"/");
      mysqli_close($connection);
      header("Location: ../../../");
      exit();
    }
  } catch (Exception $e) {
    $_SESSION['backData'] = [$login,$email,$pass,$passrep];
    $_SESSION['signup_error'] = "Something went wrong. Try later";
    header("Location: ../../../signup");
    exit();
  }

}
?>
