<?php
session_start();
unset($_COOKIE['signed_up_already']);
setcookie("signed_up_already",null,-1,"/");
unset($_SESSION['signed_up']);
header("Location: ../../");
exit();
?>
