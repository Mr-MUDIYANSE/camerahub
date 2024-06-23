<?php

require "connection.php";

$id = $_GET["id"];

Database::iud("UPDATE `product` SET `status_id` = '1' WHERE id = '".$id."'");
echo("success");

?>