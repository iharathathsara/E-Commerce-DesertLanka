<?php

require "connection.php";

$product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
$product_num = $product_rs->num_rows;

if ($product_num == 1) {

    $product_data = $product_rs->fetch_assoc();
    $status_id = $product_data["status_id"];

    if ($status_id == 1) {

        Database::iud("UPDATE  `product` SET `status_id`='2' WHERE `id`='" . $product_id . "' ");
        echo "deactivated";
    } else if ($status_id == 2) {
        Database::iud("UPDATE  `product` SET `status_id`='1' WHERE `id`='" . $product_id . "' ");
        echo "activated";
    }
} else {
    echo "Something Weng wrong. Please try again later.";
}
