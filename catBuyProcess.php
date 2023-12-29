<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $txt = $_GET["txt"];

    $uemail = $_SESSION["u"]["email"];
    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $uemail . "'");
    $address_rs_num = $address_rs->num_rows;

    $total = 0;
    $subTotal = 0;
    $shipping = 0;

    $cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON `cart`.`product_id`=`product`.`id` WHERE `cart`.`user_email`='" . $uemail . "' AND `product`.`title` LIKE '%" . $txt . "%'");
    $cart_num = $cart_rs->num_rows;

    $address_data = $address_rs->fetch_assoc();
    $address = $address_data["line1"] . "," . $address_data["line2"];
    $city_id = $address_data["city_id"];

    $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
    $district_data = $district_rs->fetch_assoc();
    $district_id = $district_data["district_id"];

    for ($x = 0; $x < $cart_num; $x++) {

        $cart_data = $cart_rs->fetch_assoc();

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();

        $total = $total + ($product_data["price"] * $cart_data["qty"]);

        $ship = 0;

        if ($district_id == 9) {
            $ship = $product_data["delivery_fee_colombo"];
            $shipping = $shipping + $product_data["delivery_fee_colombo"];
        } else {
            $ship = $product_data["delivery_fee_other"];
            $shipping = $shipping + $product_data["delivery_fee_other"];
        }
    }

    $array;

    $order_id = uniqid();
    $item = "Cart Items";
    $amount = ((int)$total) + (int)$shipping;

    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $uaddress = $address;
    $city = $district_data["name"];

    $array["id"] = $order_id;
    $array["item"] = $item;
    $array["amount"] = $amount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["address"] = $uaddress;
    $array["city"] = $city;
    $array["umail"] = $uemail;

    echo json_encode($array);
} else {
    echo ("1");
}
