<?php

session_start();

require "connection.php";

if (isset($_SESSION["p"])) {

    $product_id = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $cost = $_POST["c"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];

    Database::iud("UPDATE `product` SET `title`='" . $title . "',`price`='" . $cost . "',`delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',`description`='" . $description . "' WHERE `id`='" . $product_id . "' ");

    echo "Product Updated Successfully. ";

    $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (isset($_FILES["i0"])) {

        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_id . "'");
        $image_num = $image_rs->num_rows;

        for ($z = 0; $z < $image_num; $z++) {

            $image = $_FILES["i" . $z];

            $file_extention = $image["type"];

            if (!in_array($file_extention, $allowed_img_extentions)) {
                echo "Invalid image type.";
            } else {
                $newExtention;

                if ($file_extention == "image/jpg") {
                    $newExtention = ".jpg";
                } else if ($file_extention == "image/jpeg") {
                    $newExtention = ".jpeg";
                } else if ($file_extention == "image/png") {
                    $newExtention = ".png";
                } else if ($file_extention == "image/svg+xml") {
                    $newExtention = ".svg";
                }

                $file_name = "resourses//product_img//" . uniqid() . $newExtention;
                move_uploaded_file($image["tmp_name"], $file_name);

                $image_data = $image_rs->fetch_assoc();

                Database::iud("UPDATE `images` SET `code`='" . $file_name . "' 
                WHERE `product_id`='" . $image_data["product_id"] . "' AND `code`='" . $image_data["code"] . "' ");

                if ($z == 2) {
                    echo "Product Image updated successfully";
                }
            }
        }
    }
} else {
    echo "Something went wrong. Please try again";
}
