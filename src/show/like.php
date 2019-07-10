<?php
session_start();
if(isset($_SESSION["signed_up"]))
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
            $forID = $check->fetch_assoc();
            $id = $forID["id"];
            $creator = $forID["fromm"];
            $forStatsName = $creator."_liking";
            $today = date("Y/m/d");
            if(isset($_SESSION["signed_up"]))
            {
                $checkIfLiked = $connection->query("SELECT * FROM sent_likes WHERE fromm = '$name' AND forWhichSlide = $id");
                if(!$checkIfLiked) throw new Exception($connection->error);
                if($checkIfLiked->num_rows == 0)
                {
                    $like = $connection->query("INSERT INTO sent_likes VALUES(NULL,'$name',$id)");
                    if(!$like) throw new Exception($connection->error);
                    $update = $connection->query("UPDATE slides SET likes = likes + 1 WHERE id = $id");
                    if(!$update) throw new Exception($connection->error);
                    $secondUpdate = $connection->query("UPDATE $forStatsName SET quantity = quantity + 1 WHERE date = '$today'");
                    if(!$secondUpdate) throw new Exception($connection->error);
                    echo "like";
                }
                else
                {
                    $likeRow = $checkIfLiked->fetch_assoc();
                    $likeId = $likeRow["id"];
                    $dislike = $connection->query("DELETE FROM sent_likes WHERE id = $likeId");
                    if(!$dislike) throw new Exception($connection->error);
                    $update = $connection->query("UPDATE slides SET likes = likes - 1 WHERE id = $id");
                    if(!$update) throw new Exception($connection->error);
                    $secondUpdate = $connection->query("UPDATE $forStatsName SET quantity = quantity - 1 WHERE date = '$today'");
                    if(!$secondUpdate) throw new Exception($connection->error);
                    echo "dislike";  
                }
            }
            else
            {
                $cookieName = $slide."_liked";
                $cookieName = htmlentities($cookieName,ENT_QUOTES,"UTF-8");
                $cookieName = str_replace(" ","\s",$cookieName);
                if(!isset($_COOKIE[$cookieName]))
                {
                    $update = $connection->query("UPDATE slides SET likes = likes + 1 WHERE id = $id");
                    if(!$update) throw new Exception($connection->error);
                    
                    $secondUpdate = $connection->query("UPDATE $forStatsName SET quantity = quantity + 1 WHERE date = '$today'");
                    if(!$secondUpdate) throw new Exception($connection->error);
                    setcookie($cookieName,1,time()+86400*370,"/");  
                    echo "like";
                }
                else
                {
                    $update = $connection->query("UPDATE slides SET likes = likes - 1 WHERE id = $id");
                    if(!$update) throw new Exception($connection->error);
                    $secondUpdate = $connection->query("UPDATE $forStatsName SET quantity = quantity - 1 WHERE date = '$today'");
                    if(!$secondUpdate) throw new Exception($connection->error);
                    setcookie($cookieName,null,-1,"/");     
                    echo "dislike";        
                }
            }
            
        }
    }
}
catch (Exception $e){
    echo "failure";
}