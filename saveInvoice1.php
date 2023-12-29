<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $o_id = $_POST["o"];
    $txt = $_POST["t"];
    $mail = $_POST["m"];
    $famount = $_POST["a"];

    $uemail = $_SESSION["u"]["email"];
    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $uemail . "'");
    $address_rs_num = $address_rs->num_rows;

    $total = 0;
    $subTotal = 0;

    $cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON `cart`.`product_id`=`product`.`id` WHERE `cart`.`user_email`='" . $uemail . "' AND `product`.`title` LIKE '%" . $txt . "%'");
    $cart_num = $cart_rs->num_rows;

    $address_data = $address_rs->fetch_assoc();
    $address = $address_data["line1"] . "," . $address_data["line2"];
    $city_id = $address_data["city_id"];

    $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
    $district_data = $district_rs->fetch_assoc();
    $district_id = $district_data["district_id"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    for ($x = 0; $x < $cart_num; $x++) {

        $cart_data = $cart_rs->fetch_assoc();
        $qty = $cart_data["qty"];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();

        $p_id = $product_data["id"];

        $total = ($product_data["price"] * $cart_data["qty"]);
        $ship = 0;

        if ($district_id == 9) {
            $ship = $product_data["delivery_fee_colombo"];
        } else {
            $ship = $product_data["delivery_fee_other"];
        }
        $amount = $total + $ship;

        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`user_email`) VALUES
    ('" . $o_id . "','" . $date . "','" . $amount . "','" . $qty . "','0','" . $p_id . "','" . $mail . "')");
    }

    echo ("1");
}
