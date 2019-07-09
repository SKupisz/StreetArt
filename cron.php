<?php
echo "Started insert \n";
$connect = require_once "./src/mainComponents/connect.php";
try{
    $connection = new mysqli($connect["host"],$connect["db_user"],$connect["db_password"],$connect["db_name"]);
    if($connection->connect_errno != 0)
    {
        throw new Exception($connection->connect_error);
    }
    else{
        $users = $connection->query("SELECT * FROM users");
        if(!$users) throw new Exception($connection->error);
        echo "users taken from the database \n";
        $length = $users->num_rows;
        for($i = 0 ; $i < $length; $i++)
        {
            $row = $users->fetch_assoc();
            $viewsName = $row["nickname"]."_showing";
            $likesName = $row["nickname"]."_liking";
            $today = date("Y/m/d");
            $check = $connection->query("SELECT * FROM $viewsName WHERE date = '$today'");
            if(!$check) throw new Exception($connection->error);
            if($check->num_rows == 0)
            {
                $executeViews = $connection->query("INSERT INTO $viewsName VALUES(NULL,'$today',0)");
                if(!$executeViews) throw new Exception($connection->error);
            }
            $check = $connection->query("SELECT * FROM $likesName WHERE date = '$today'");
            if(!$check) throw new Exception($connection->error);
            if($check->num_rows == 0)
            {
                $exetuteLikes = $connection->query("INSERT INTO $likesName VALUES(NULL,'$today',0)");
                if(!$exetuteLikes) throw new Exception($connection->error);
            }
        }
    }
    echo "Succesful insert. Have a nice day \n";
}
catch(Exception $e)
{
    echo "Failed to make a new date. Execute one more time \n";
}