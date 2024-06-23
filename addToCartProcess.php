<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["email"];
        $product_id = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $product_id . "' AND `user_email`='" . $email . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["qty"];

        if ($cart_num == 1) {
            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["c_qty"];
            $new_qty = (int)$current_qty + 1;

            if ($product_qty >= $new_qty) {

                Database::iud("UPDATE `cart` SET `c_qty`='" . $new_qty . "' WHERE `product_id`='" . $product_id . "' AND `user_email`='" . $email . "'");
                echo ("Product Updated");
            } else {
                echo ("Invalid quantity");
            }
        }else {
            Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`c_qty`) VALUES ('".$product_id."','".$email."','1')");
            echo("Product added successfully");
        }
    } else {
        echo ("Something went wrong");
    }
} else {
    echo ("Please Login or Register.");
}
