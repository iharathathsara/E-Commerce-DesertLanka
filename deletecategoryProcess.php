<?php
require "connection.php";
$cid = $_GET["id"];

$category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $cid . "'");
$category_num = $category_rs->fetch_assoc();
if ($category_num == 0) {
    echo "Somthing Missing";
} else {

    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $cid . "'");
    $product_num = $product_rs->num_rows;
    if ($product_num == 0) {
    } else {
        $product_data = $product_rs->fetch_assoc();
        Database::iud("DELETE FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
        Database::iud("DELETE FROM `product` WHERE `category_id`='" . $cid . "'");
    }

    Database::iud("DELETE FROM `model_has_category` WHERE `category_id`='" . $cid . "'");
    Database::iud("DELETE FROM `category` WHERE `id`='" . $cid . "'");

    echo "success";
}
