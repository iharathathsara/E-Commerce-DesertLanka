<?php

session_start();
require "connection.php";

$sender;

if (isset($_SESSION["u"])) {

    $sender = $_SESSION["u"]["email"];
} else if (isset($_SESSION["a"])) {

    $sender = $_SESSION["a"]["email"];
}

$recever = $_POST["e"];
$msg = $_POST["t"];

$file_name = 0;

if (isset($_FILES["image"])) {

    $image = $_FILES["image"];

    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    $file_ex = $image["type"];

    if (!in_array($file_ex, $allowed_image_extentions)) {
        echo "Please select a valid image.";
    } else {

        $new_image_extention;

        if ($file_ex == "image/jpg") {
            $new_image_extention = ".jpg";
        } else if ($file_ex == "image/jpeg") {
            $new_image_extention = ".jpeg";
        } else if ($file_ex == "image/png") {
            $new_image_extention = ".png";
        } else if ($file_ex == "image/svg+xml") {
            $new_image_extention = ".svg";
        }

        $file_name = "resourses//chat_img//" . uniqid() . $new_image_extention;

        move_uploaded_file($image["tmp_name"], $file_name);
    }
} else {
}

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `msg`(`content`,`msg_img`,`date_time`,`status`,`from`,`to`) VALUES ('" . $msg . "','" . $file_name . "','" . $date . "','0','" . $sender . "','" . $recever . "')");

echo ("success");
