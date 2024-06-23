<?php

require "connection.php";

$email = $_GET["email"];

Database::iud("UPDATE `user` SET `status` = '0' WHERE email = '".$email."'");
echo("success");

?>