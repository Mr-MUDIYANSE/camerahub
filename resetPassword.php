<?php

require "connection.php";

$verificationcode = $_POST["verificationcode"];
$email = $_POST["email"];


    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code`='".$verificationcode."'");
    $n = $rs->num_rows;

    if ($n == 1) {
        echo("success");
    }else {
        echo("Invalid Email or Verification Code");
    }
// }

?>