<?php

session_start();
require "connection.php";

$msg_txt = $_POST["t"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$sender = $_SESSION["a"]["email"];
$receiver = $_POST["r"];

Database::iud("INSERT INTO `msg`(`content`,`date_time`,`status`,`from`,`to`) VALUES ('" . $msg_txt . "','" . $date . "','0','" . $sender . "','" . $receiver . "')");

echo ("success");
