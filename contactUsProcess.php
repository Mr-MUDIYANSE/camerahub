<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); // Ensure session is started

if (isset($_SESSION["u"])) {
    $name = $_POST["name"];
    $email = $_SESSION["u"]["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $msg = $_POST["msg"];


    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kanishka2001.info@gmail.com';
            $mail->Password = 'lqeu tmqg kmjr nmwj';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($email, 'CameraHub');
            $mail->addReplyTo($email, 'CameraHub');
            $mail->addAddress('kanishkarosairo98@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "<p>Name: $name</p><p>Message: $msg</p><p>Phone: $phone</p><p>Email: $email</p>";

            $mail->send();
            echo "Success";
        } catch (Exception $e) {
            echo "Verification code sending failed. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid email format";
    }
} else {
    echo "User is not authenticated.";
}
?>
