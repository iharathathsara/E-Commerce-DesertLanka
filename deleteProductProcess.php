<?php
session_start();
require "connection.php";
if (isset($_SESSION["a"])) {
    if (isset($_GET["id"])) {
        $pid = $_GET["id"];
        Database::iud("DELETE FROM `images` WHERE `product_id`='" . $pid . "'");
        Database::iud("DELETE FROM `product` WHERE `id`='" . $pid . "'");
        echo "success";
    } else {
        echo "Somthing missing";
    }
}else{
    echo "sign in";
}
