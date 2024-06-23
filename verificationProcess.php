<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
    
    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if ($n == 1) {
    
       $code =  uniqid();

       Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

       $mail = new PHPMailer;
       $mail->IsSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'kanishkarosairo98@gmail.com';
       $mail->Password = 'rlrtxtwxjnohaktx';
       $mail->SMTPSecure = 'ssl';
       $mail->Port = 465;
       $mail->setFrom('kanishkarosairo98@gmail.com', 'Reset Password');
       $mail->addReplyTo('kanishkarosairo98@gmail.com', 'Reset Password');
       $mail->addAddress($email);
       $mail->isHTML(true);
       $mail->Subject = 'E-Shop Forgot Password Verification Code';
       $bodyContent = '<h1 style="color:green">Your Verification Code is '.$code.'</h1>';
       $mail->Body    = $bodyContent;

       if (!$mail->send()) {
        echo("Verificatin code sending fail");
       }else {
        echo("success");
       }

    }else {
        echo("Invalid Email address");
    }
}

?>