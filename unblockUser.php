<?php

require "connection.php";

$email = $_GET["email"];

Database::iud("UPDATE `user` SET `status` = '1' WHERE email = '".$email."'");
echo("success");

?>