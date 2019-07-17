<?php
session_start();
if(!isset($_SESSION["signed_up"])){
    header("Location: ../../../");
    exit();
}
if(!isset($_POST['delete']) && !isset($_POST['permission'])){
    header("Location: ../../../profile/settings");
    exit();
}
else if((isset($_POST['delete']) && !isset($_POST["permission"])) || isset($_SESSION["password-error-vanish"])){
    
    ?>
    <html>
        <head>
            <title>Verification</title>
            <link rel = "stylesheet" href = "./css/verification.css"/>
            <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        </head>
        <body>
            <form method = "post" action = "">
                <header class = "main-header">Verification</header>
                <div class = "desc">Confirm password to continue</div>
                <?php if(isset($_SESSION['password-error-vanish'])){
                    ?><div class = "error"><?php echo $_SESSION["password-error-vanish"];?></div><?php
                    unset($_SESSION["password-error-vanish"]);
                } ?>
                <input type = "password" name = "permission" class = "password-input" required placeholder = "Your password here"/>
                <div class = "button-container">
                    <button class = "submit-btn" type = "submit">Confirm password</button>
                </div>
            </form>
        </body>
    </html>
    <?php
}
else
{
    unset($_SESSION["password-error-vanish"]);
    $pass = $_POST['permission'];
    if(strlen($pass) < 8){
        $_SESSION["password-error-vanish"] = "Incorrect password";
        header("Location: vanishAccount.php");
        exit();
    }
    $connect = require_once "../../mainComponents/connect.php";
    try{
        $connection = new mysqli($connect["host"],$connect["db_user"],$connect["db_password"],$connect["db_name"]);
        if($connection->connect_errno != 0){
            throw new Exception($connection->connect_error);
        }
        else{
            $name = $_SESSION["signed_up"];
            $forCheck = $connection->query("SELECT * FROM users WHERE nickname = '$name'");
            if(!$forCheck) throw new Exception($connection->error);
            $checkRow = $forCheck->fetch_assoc();
            $showing = $name."_showing";
            $liking = $name."_liking";
            if(password_verify($pass,$checkRow['password'])){
                $delSlides = $connection->query("DELETE FROM slides WHERE fromm = '$name'");
                if(!$delSlides) throw new Exception($connection->error);
                $vanishShowing = $connection->query("UPDATE $showing SET quantity = 0 WHERE 1=1");
                if(!$vanishShowing) throw new Exception($connection->error);
                $likingShowing = $connection->query("UPDATE $liking SET quantity = 0 WHERE 1=1");
                if(!$likingShowing) throw new Exception($connection->error);
                header("Location: ../../../profile/show");
                exit();
            }
            else
            {
                $_SESSION["password-error-vanish"] = "Incorrect password";
                header("Location: vanishAccount.php");
                exit();
            }
        }
    } catch (Exception $e){
        $_SESSION["password-error-vanish"] = "Something went wrong. Try later";
        header("Location: vanishAccount.php");
        exit();   
    }
}
