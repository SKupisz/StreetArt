<?php
if(!isset($_SESSION["signed_up"])){
    header("Location: ../../");
    exit();
}
if(isset($_SESSION["fail-table"]))
{
    $fail = 1;
}
else
{
    $fail = 0;
}
$name = $_SESSION["signed_up"];
$connect = require_once "../../src/mainComponents/connect.php";
try{
    $connection = new mysqli($connect["host"],$connect["db_user"],$connect["db_password"],$connect["db_name"]);
    if($connection->connect_errno != 0){
        throw new Exception($connection->connect_error);
    }
    else
    {
        $basicData = $connection->query("SELECT * FROM users WHERE nickname = '$name'");
        if(!$basicData) throw new Exception($connection->error); 
        $toGetData = $basicData->fetch_assoc();
        $email = $toGetData["email"];
        $website = $toGetData["website"];
    }
} catch(Exception $e){
    $_SESSION["changing-error"] = "Sorry, something went wrong. Try later";
}