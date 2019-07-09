<?php
session_start();
if(!isset($_SESSION["signed_up"]))
{
    if(isset($_COOKIE["signed_up_already"]))
    {
        $value = $_COOKIE["signed_up_already"];
        $value = explode(" ",$value);
        if(count($value) == 2)
        {
            $_SESSION["signed_up"] = $value[0];
        }
    }
}