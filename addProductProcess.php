<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand= $_POST["b"];
$modal= $_POST["m"];
$title= $_POST["t"];
$clr= $_POST["col"];
$clr_input= $_POST["col_in"];
$qty= $_POST["qty"];
$cost= $_POST["cost"];
$desc= $_POST["desc"];


if ($category == "0") {
    echo("Please select a Category.");
}elseif ($brand == "0") {
    echo("Please select a Brand.");
}elseif ($modal == "0") {
    echo("Please select a modal.");
}elseif (empty($title)) {
    echo("Please Enter a Title.");
}elseif (strlen($title <= 100)) {
    echo("Title should have lover than 100 characters");
}elseif ($clr == "0") { 
        echo("Please select a Color.");  
}elseif (empty($qty)) {
    echo("Please Enter the Quantity.");
}elseif ($qty == "0" | $qty == "e" | $qty < 0) {
    echo("Invalid Input or Quantity");
}elseif (empty($cost)) {
    echo("Please Enter the price");
}elseif (!is_numeric($cost)) {
    echo("Invalid input for cost");
}elseif (empty($desc)) {
    echo("Please Enter a Description.");
}else {
    
$mhb_rs = Database::search(("SELECT * FROM `modal_has_brand` WHERE `brand_id`='".$brand."' && `modal_id`='".$modal."' "));

$modal_has_brand_id;

if ($mhb_rs->num_rows == 1) {

    $mhb_data = $mhb_rs->fetch_assoc();
    $modal_has_brand_id = $mhb_data["id"];

}else {
    
    Database::iud("INSERT INTO `modal_has_brand`(`brand_id`,`modal_id`) VALUES ('".$brand."','".$modal."') ");
    $modal_has_brand_id = Database::$connection->insert_id;
}

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;


Database::iud("INSERT INTO `product` (`category_id`,`modal_has_brand_id`,`color_id`,`price`,`qty`,`description`,`title`,`status_id`,
`user_email`,`datetimee_added`,`deal_id`) VALUES
 ('".$category ."','".$modal_has_brand_id."','".$clr."','".$cost."','".$qty."','".$desc."','".$title."','".$status."',
 '".$email."','".$date."','2') ");

 echo("Product saved Successfully.");

$product_id = Database::$connection->insert_id;

$length = sizeof($_FILES);

if ($length <= 3 && $length > 0) {
    
$allowed_image_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

for ($x=0; $x < $length; $x++) { 
    if (isset($_FILES["image".$x])) {
        
        $img_file = $_FILES["image".$x];
        $file_extention = $img_file["type"];

        if (in_array($file_extention,$allowed_image_extentions)) {
            
            $new_img_extention;

            if ($file_extention == "image/jpg") {
                $new_img_extention = ".jpg";
            }elseif ($file_extention == "image/jpeg") {
                $new_img_extention = ".jpeg";
            }elseif ($file_extention == "image/png") {
                $new_img_extention = ".png";
            }elseif ($file_extention == "image/svg+xml") {
                $new_img_extention = ".svg";
            }

            $file_name = "resources//mobile_images//".$title."_".$x."_".uniqid().$new_img_extention;
            move_uploaded_file($img_file["tmp_name"],$file_name);

            Database::iud("INSERT INTO `images` (`name`,`product_id`) VALUES ('".$file_name."','".$product_id."') ");

         

        }else {
            echo("Invalid Image type.");
        }
    }
}
echo("Product Image saved successfully");

}else {
    echo("Invalid Image Count");
}

 
}

?>