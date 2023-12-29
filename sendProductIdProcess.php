<?php

session_start();

$user_email = $_SESSION["a"]["email"];

require "connection.php";

$Product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $Product_id . "' AND `users_email`='" . $user_email . "' ");

$product_num = $product_rs->num_rows;

if ($product_num == 1) {

    $product_data = $product_rs->fetch_assoc();
    $_SESSION["p"] = $product_data;
    echo "success";
} else {
    echo "Something went wrong";
}
