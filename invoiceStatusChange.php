<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_POST["statusId"]) && isset($_POST["inoviceId"])) {
        $statusId = $_POST["statusId"];
        $inoviceId = $_POST["inoviceId"];
        Database::iud("UPDATE `invoice` SET `status`='" . $statusId . "' WHERE `in_id`='" . $inoviceId . "'");
        echo("success");
    }
}

?>