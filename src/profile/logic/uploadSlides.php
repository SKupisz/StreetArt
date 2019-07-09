<?php
session_start();
if(!isset($_SESSION['signed_up']))
{
  header("Location: ../../../");
  exit();
}
if(!isset($_POST['slideshowName']) || !isset($_POST['quantity']))
{
  header("Location: ../../../profile/create");
  exit();
}
$quantity = $_POST['quantity'];
$slideName = $_POST['slideshowName'];
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
    $ifDir = $connection->query("SELECT * FROM users WHERE nickname = '$name'");
    if(!$ifDir) throw new Exception($connection->error);
    $forFind = $ifDir->fetch_assoc();
    $terminal= $forFind["presAddress"];
    $id = $forFind["id"];
    if($terminal == "No direction yet")
    {

      $address = "../../../u72t4yituewykgs/".$name."/";
      $forCommit = "u72t4yituewykgs/".$name."/";
      $commit = $connection->query("UPDATE users SET presAddress = '$forCommit' WHERE id = $id");
      if(!$commit) throw new Exception($connection->error);
      mkdir($address,0700);
      $terminal = $forCommit;
    }
      $dir = "../../../".$terminal.$slideName."/";
      mkdir($dir,0700);
      for($i = 0 ; $i < $quantity; $i++)
      {
        $uploadOk = 1;
        $target_dirname = $dir.basename($_FILES["userfile"]["name"][$i]);
        $imageType = strtolower(pathinfo($target_dirname,PATHINFO_EXTENSION));
        $target_dirname = $dir.$slideName."$i".".".$imageType;
        $messageError = "";
        echo $target_dirname;
        if(file_exists($target_dirname))
        {
          $uploadOk = 0;
          $_SESSION['slide_error'] = "Cannot upload files";
          header("Location: ../../../profile/create");
          exit();
        }
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
        && $imageType != "gif")
        {
          $uploadOk = 0;
        }
        if($uploadOk == 0)
        {
          $_SESSION['slide_error'] = "Cannot upload files";
          header("Location: ../../../profile/create");
          exit();
        }
        else {
          if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],$target_dirname))
          {

          }
          else {
            $_SESSION['slide_error'] = "Cannot upload files";
            header("Location: ../../../profile/create");
            exit();
          }
        }
      }
      $showName = $_POST['slideshowName'];
      $showName = htmlentities($showName);
      $terminal.=$showName;
      $insertDir = $connection->query("INSERT INTO slides VALUES(NULL,'$name','$showName','$terminal',0,0)");
      if(!$insertDir) throw new Exception($connection->error);
      $increment = $connection->query("UPDATE users SET slidersCounter = slidersCounter + 1 WHERE nickname = '$name'");
      if(!$increment) throw new Exception($connection->error);
      mysqli_close($connection);
      $_SESSION['uploadDone'] = "Your slideshow is now aviable at: /show?u=".$name."&n=".$_POST['slideshowName'];
      header("Location: ../../../profile/createDone");
      exit();

  }
} catch (Exception $e) {
  $_SESSION['slide_error'] = "Something went wrong. Try later";
  header("Location: ../../../profile/create");
  exit();
}

?>
