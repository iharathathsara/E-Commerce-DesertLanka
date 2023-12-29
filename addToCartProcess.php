<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $uemail = $_SESSION["u"]["email"];

        $cartPorduct_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "' AND `product_id`='" . $pid . "'");
        $cart_product_num = $cartPorduct_rs->num_rows;

        if ($cart_product_num == 1) {
            $cartProductData = $cartPorduct_rs->fetch_assoc();
            $currentQty = $cartProductData["qty"];
            $newQty = (int) $currentQty + 1;

                Database::iud("UPDATE `cart` SET `qty`='" . $newQty . "' WHERE `user_email`='" . $uemail . "' AND `product_id`='" . $pid . "' ");
                echo "Product quantity Updated";
           
        } else {

            Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES ('" . $pid . "','" . $uemail . "','1')");

            echo "New Product added to the cart";
        }
    } else {
        echo "Sorry For the Inconvenient";
    }
} else {
    echo "Please Log In or Sign Up";
}
