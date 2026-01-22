<?php
session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid();

        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE 
        `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ravinduk01@gmail.com';
        $mail->Password = 'hqregddrqgjmkzsu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ravinduk01@gmail.com', 'Reset Password');
        $mail->addReplyTo('ravinduk01@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Shoes.com Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:green">Your Verification code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed';
        } else {
            echo 'Success';
            $_SESSION["e"] = $email;
            $_SESSION["vc"] = $code;
        }
    } else {
        echo ("Invalid Email address");
    }
} else if (isset($_GET["vc"])) {

    if ($_GET["vc"] == $_SESSION["vc"]) {

        echo ("Success");
        unset($_SESSION["vc"]);
    } else {

        echo ("Invalid Verification Code");
    }
} else if (isset($_POST["p"])) {

    Database::iud("UPDATE `user` SET `password`='" . $_POST["p"] . "' WHERE 
        `email`='" . $_SESSION["e"] . "'");

        echo("Success");
        unset($_SESSION["e"]);

}
