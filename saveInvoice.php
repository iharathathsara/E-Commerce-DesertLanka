<?php 

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $o_id = $_POST["o"];
    $p_id = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$p_id."'");
    $product_data = $product_rs->fetch_assoc();

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`user_email`) VALUES
    ('".$o_id."','".$date."','".$amount."','".$qty."','0','".$p_id."','".$mail."')");

    echo ("1");

}
