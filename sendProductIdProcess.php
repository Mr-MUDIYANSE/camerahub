<?php

session_start();

require "connection.php";

$email = $_SESSION["u"]["email"];

$p = $_GET["id"];

// echo($p);
// echo($email);

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$p."' AND `user_email`='".$email."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){

    $product_data = $product_rs->fetch_assoc();
    $_SESSION["product"] = $product_data;
    echo ("success");

}else{

    echo "Something went wrong";

}

?>