<?php

session_start();
require "connection.php";

if (isset($_SESSION["product"])) {
    $pid = $_SESSION["product"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $price = $_POST["p"];
    $description = $_POST["d"];

    // echo($title);
    // echo($qty);
    // echo($price);
    // echo($description);
    

    Database::iud("UPDATE `product` SET `title`='".$title."',`qty`='".$qty."',`price`='".$price."',
    `description`='".$description."' WHERE `id`='".$pid."' ");

    echo("Product has been Updated!");

    $length = sizeof($_FILES);
    $allowed_img_extenstions = array("image/jpg","image/jpeg","image/png","image/svg+xml");
    
    Database::iud("DELETE FROM `images` WHERE `product_id` ='".$pid."'");

    if ($length <= 3 && $length > 0) {
        
        for ($x=0; $x <$length ; $x++) { 
            if (isset($_FILES["i".$x])) {
                $img_file = $_FILES["i".$x];
                $file_type = $img_file["type"];

                if (in_array($file_type,$allowed_img_extenstions)) {

                    $new_img_extention;

                    if ($file_type == "image/jpg") {
                        $new_img_extention = " .jpg";
                    }elseif ($file_type == "image/jpeg") {
                        $new_img_extention = " .jpeg";
                    }elseif ($file_type == "image/png") {
                        $new_img_extention = " .png";
                    }elseif ($file_type == "image/svg+xml") {
                        $new_img_extention = " .svg";
                    }

                    $file_name = "resources//mobile_images//".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);


                    Database::iud("INSERT INTO `images` (`name`,`product_id`) VALUES ('".$file_name."','".$pid."')");

                    echo("success");
                    
                }else {
                    echo("File type not allowed!");
                }
            }
        }
    }else {
        echo("Invalid image count!");
    }
}
