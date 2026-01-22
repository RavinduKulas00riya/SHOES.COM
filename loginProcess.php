<?php
session_start();
require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberme = $_POST["rememberMe"];

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
$n = $rs->num_rows;

if ($n != 1) {
    echo("Wrong Email or Password");
} else {
    $d = $rs->fetch_assoc();
    $_SESSION['user'] = $d;

    if ($rememberme == "true") {

        setcookie("email", $email, time() + (60 * 60 * 24 * 365));
        setcookie("password", $password, time() + (60 * 60 * 24 * 365));
    } else {

        setcookie("email", "", -1);
        setcookie("password", "", -1);
    }
    echo("success");
}
