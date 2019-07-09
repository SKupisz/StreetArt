<?php
session_start();
if(!isset($_SESSION["signed_up"]))
{
    $name = $_SESSION["signed_up"];
}
else
{
    $name = "";
}
if(!isset($_GET["n"]))
{
    header("Location: ../../");
    exit();
}
$slide = $_GET['n'];
$slide = htmlentities($slide);
$connect = require_once "../mainComponents/connect.php";
try{
    $connection = new mysqli($connect["host"],$connect["db_user"],$connect["db_password"],$connect["db_name"]);
    if($connection->connect_errno != 0)
    {
        throw new Exception($connection->connect_error);
    }
    else{
        $check = $connection->query("SELECT * FROM slides WHERE name = '$slide'");
        if(!$check) throw new Exception($connection->error);
        if($check->num_rows != 0){
            // Tutaj robimy wysłanie lajka, jeśli niezalogowany, to wysyłamy anonimowego(plus ciasteczko), jeśli zalogowany, to wysyłamy jako konto
        }
    }
}
catch (Exception $e){

}