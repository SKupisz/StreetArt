<?php
session_start();
if(!isset($_SESSION["signed_up"])){
    header("Location: ../../../../");
    exit();
}
if(!isset($_POST['newpass']) || !isset($_POST['newrep'])){
    header("Location: ../../../../profile/settings");
    exit();
}
$new = $_POST['newpass'];
$rep = $_POST["newrep"];
if(strlen($new) < 8)
{
    $_SESSION["fail-table"] = [$new,$rep];
    $_SESSION["not-this-password"] = "Your password must have at least 8 signs";
    header("Location: ../../../../profile/settings");
    exit();
}
if($new != $rep){
    $_SESSION["fail-table"] = [$new,$rep];
    $_SESSION["not-this-password"] = "Password are not the same";
    header("Location: ../../../../profile/settings");
    exit();  
}
$name = $_SESSION["signed_up"];
$connect = require_once "../../../mainComponents/connect.php";
try{
    $connection = new mysqli($connect["host"],$connect["db_user"],$connect["db_password"],$connect["db_name"]);
    if($connection->connect_errno != 0){
        throw new Exception($connection->connect_error);
    }
    else
    {
        $new = password_hash($new,PASSWORD_DEFAULT);
        $update = $connection->query("UPDATE users SET password = '$new' WHERE nickname = '$name'");
        if(!$update) throw new Exception($connection->error);
        $value = $name." ".$new;
        setCookie("signed_up_already",$value,time()+(86400*30),"/");
        $_SESSION["password-changed"] = "Password has been successfully changed";
        header("Location: ../../../../profile/settings");
        exit();
    }
} catch (Exception $e){
    $_SESSION["fail-table"] = [$new,$rep];
    $_SESSION["not-this-password"] = "Sorry, something went wrong. Try later";
    header("Location: ../../../../profile/settings");
    exit();
}