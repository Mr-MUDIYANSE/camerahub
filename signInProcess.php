<?php

session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if(empty($email)){
    echo("Please enter your Email");
}elseif (strlen($email) > 100) {
    echo("Email must have less than 100 characters");
}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    echo("Invalid Email");
}elseif (empty($password)) {
    echo("Please enter your Password");
}elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo("Password must have between 5-20 characters");
}else {
    
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."'");
    $n = $rs->num_rows;

if ($n ==1 ) {
    
    echo("success");
    $d = $rs->fetch_assoc();
    $_SESSION["u"] = $d;

    if ($rememberme == "true") {
        setcookie("email", $email, time() + (60 * 60 * 24 * 365));
        setcookie("password", $password, time() + (60 * 60 * 24 * 365));
    }else {
        setcookie("email", "", -1);
        setcookie("password", "", -1);
    }

}else {
    echo("Invalid Username or Password");
}

}   
