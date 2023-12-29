<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $qty = $_GET["qty"];
        $uemail = $_SESSION["u"]["email"];

        Database::iud("UPDATE `cart` SET `qty`='" . $qty . "' WHERE `product_id`='" . $pid . "' AND `user_email`='" . $uemail . "' ");

        echo "Product QTY updated";
    } else {
        echo "Sorry For the Inconvenient";
    }
} else {
    echo "Please Log In or Sign Up";
}
