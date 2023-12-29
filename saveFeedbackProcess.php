<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $mail = $_SESSION["u"]["email"];
    $type = $_POST["t"];
    $iid = $_POST["i"];
    $feedback = $_POST["f"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`feedback`,`date`,`type_id`,`invoice_id`) VALUES
    ('".$feedback."','".$date."','".$type."','".$iid."')");

    echo ("1");

}
