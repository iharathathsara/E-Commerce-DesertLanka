<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='" . $pid . "'");
    $cart_data = $cart_rs->fetch_assoc();

    $product_id = $cart_data["product_id"];
    $user_email = $cart_data["user_email"];

    Database::iud("INSERT INTO `recent` (`product_id`,`users_email`) VALUES ('" . $product_id . "','" . $user_email . "')");

    Database::iud("DELETE FROM `cart` WHERE `id`='" . $pid . "'");

    echo "success";
} else {
    echo "Something went wrong.";
}
