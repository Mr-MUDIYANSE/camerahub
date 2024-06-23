<?php

require "connection.php";

$email = $_POST["email"];
$newpw = $_POST["newpw"];
$rpw = $_POST["rpw"];


if (empty($email)) {
    echo("Missing Email address");
}elseif (empty($newpw)) {
    echo("Please Enter New Password");
}elseif (strlen($newpw)<5 || strlen($newpw)>20) {
    echo("Invalid Password");
}elseif (empty($rpw)) {
    echo("Please Re-type your New Password");
}elseif ($newpw != $rpw) {
    echo("Password does not matched");
}else {
        Database:: iud("UPDATE `user` SET `password` = '".$newpw."' WHERE `email`='".$email."'");
        echo("success");
    }
?>