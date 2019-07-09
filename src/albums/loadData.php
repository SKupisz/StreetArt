<?php
$connect = require_once "../src/mainComponents/connect.php";
$isConnected = 1;
try {
  $connection = new mysqli($connect["host"],$connect["db_user"],
  $connect["db_password"],$connect["db_name"]);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    $mostPopular = $connection->query("SELECT * FROM slides ORDER BY views");
    if(!$mostPopular) throw new Exception($connection->error);
    $creators = Array();
    $addresses = Array();
    $names = Array();
    $likes = Array();
    $rows = Array();
    $howMany = $mostPopular->num_rows;
    for($i = 0; $i < $howMany; $i++)
    {
      $mostPopRow = $mostPopular->fetch_assoc();
      $rows[$i] = $mostPopRow;
      $creators[$i] = $mostPopRow["fromm"];
      $addresses[$i] = $mostPopRow["address"];
      $names[$i] = $mostPopRow["name"];
      $likes[$i] = $mostPopRow["likes"];
    }
  }
} catch (Exception $e) {
  $isConnected = 0;
}

?>
