<?php
session_start();
if(!isset($_POST['email'])){
    header("Location: ../../../forgot/");
    exit();  
}
$email = $_POST['email'];
$emailAuth = htmlentities($email);
$connect = require_once "../../mainComponents/connect.php";
try {
    $connection = new mysqli($connect["host"],
    $connect["db_user"],$connect["db_password"],
    $connect["db_name"]);
    if($connection->connect_errno != 0)
    {
      throw new Exception($connection->connect_error);
    }
    else{
        $checkThisOut = $connection->query("SELECT * FROM users WHERE email = '$emailAuth'");
        if(!$checkThisOut) throw new Exception($connection->error);
        if($checkThisOut->num_rows != 0){
            $headers = array(
                'From' => "Streetart.com",
                "Reply-to" => "Streetart@wp.pl",
            );
            mail($email,'Password reset',"hello",$headers);
            header("Location: ../../../forgot/");
            exit();
        }
        else{
            $_SESSION["email-reset-fail"] = "There is no account connected with this email";
            header("Location: ../../../forgot/");
            exit();           
        }
    }
} catch (Exception $e){
    $_SESSION["email-reset-fail"] = "Sorry, something went wrong. Try later";
    header("Location: ../../../forgot/");
    exit();
}
//TODO: wysyłanie na pocztę, a w bazie danych tabela z kluczami resetującymi
?>