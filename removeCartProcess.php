<?php

require "connection.php";

if (isset($_GET["id"])) {

    $cart_id = $_GET["id"];

    // echo($cart_id);

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cart_id."'");
    $cart_num = $cart_rs->num_rows;
    $cart_data = $cart_rs->fetch_assoc();

    // echo($cart_num);

    if ($cart_num == 0) {
        echo("Something went wrong. Please try again later.");
    }else {
        Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) 
        VALUES ('".$cart_data["product_id"]."','".$cart_data["user_email"]."')");

        Database::iud("DELETE FROM `cart` WHERE `id`='".$cart_id."'");

        echo ("success");
    }
}else {
    echo("Please Select a Product");
}


?>