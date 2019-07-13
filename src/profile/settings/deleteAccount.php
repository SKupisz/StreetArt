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
else if((isset($_POST['delete']) && !isset($_POST["permission"])) || isset($_SESSION["password-error"])){
    
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
                <?php if(isset($_SESSION['password-error'])){
                    ?><div class = "error"><?php echo $_SESSION["password-error"];?></div><?php
                    unset($_SESSION["password-error"]);
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
    unset($_SESSION["password-error"]);
    $pass = $_POST['permission'];
    if(strlen($pass) < 8){
        $_SESSION["password-error"] = "Incorrect password";
        header("Location: deleteAccount.php");
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
                $delete = $connection->query("DELETE FROM users WHERE nickname = '$name'");
                if(!$delete) throw new Exception($connection->error);
                $deleteShowingStats = $connection->query("DROP TABLE $showing");
                if(!$deleteShowingStats) throw new Exception($connection->error);
                $deleteLikingStats = $connection->query("DROP TABLE $liking");
                if(!$deleteLikingStats) throw new Exception($connection->error);
                unset($_COOKIE['signed_up_already']);
                setcookie("signed_up_already",null,-1,"/");
                unset($_SESSION['signed_up']);
                header("Location: ../../../");
                exit();
            }
            else
            {
                $_SESSION["password-error"] = "Incorrect password";
                header("Location: deleteAccount.php");
                exit();
            }
        }
    } catch (Exception $e){
        $_SESSION["password-error"] = "Something went wrong. Try later";
        header("Location: deleteAccount.php");
        exit();   
    }
}
