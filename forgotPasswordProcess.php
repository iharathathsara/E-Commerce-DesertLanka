<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $resultset = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "'");
    $n = $resultset->num_rows;

    if ($n == 1) {

        $code = uniqid();

        Database::iud("UPDATE `users` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iharathathsara31@gmail.com';
        $mail->Password = 'password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('iharathathsara31@gmail.com', 'desert');
        $mail->addReplyTo('iharathathsara31@gmail.com', 'desert');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Dessert Forget Password Verification Code';
        $bodyContent = '<h1 style="color:green;">Your verification code is : ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed';
        } else {
            echo 'Success';
        }
    } else {
        echo "Email address not found.";
    }
} else {
    echo "Please Enter your Email Address.";
}
