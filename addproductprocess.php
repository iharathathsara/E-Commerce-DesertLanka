<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

    $seller_email = $_SESSION["a"]["email"];

    $category = $_POST["category"];
    $model = $_POST["model"];
    $title = $_POST["title"];
    $price = $_POST["cost"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["description"];

    //Checking price datatype

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    if ($category == "0") {
        echo "Please select the Category";
    } else if ($model == "0") {
        echo "Please select the Model";
    } else if (empty($title)) {
        echo "Please enter the title of  your product";
    } else if (strlen($title) > 100) {
        echo "Your title should be 100 or less character length.";
    } else if (empty($price)) {
        echo "Please enter the unit price of your product";
    } else if (!is_numeric($price)) {
        echo "Please enter a vaild price";
    } else if (empty($dwc)) {
        echo "Please enter the delivery price in Colombo";
    } else if (!is_numeric($dwc)) {
        echo "Please enter a vaild delivery price";
    } else if (empty($doc)) {
        echo "Please enter the delivery price out of Colombo";
    } else if (!is_numeric($doc)) {
        echo "Please enter a vaild delivery price";
    } else if (empty($description)) {
        echo "Please enter a description";
    } else {

        $mhc_rs = Database::search("SELECT * FROM `model_has_category` WHERE `model_id`='" . $model . "' && `category_id`='" . $category . "' ");

        $model_has_category_id;

        if ($mhc_rs->num_rows == 1) {

            $mhc_data = $mhc_rs->fetch_assoc();
            $model_has_category_id = $mhc_data["id"];
        } else {

            Database::iud("INSERT INTO `model_has_category`(`model_id`,`category_id`) 
            VALUES ('" . $model . "','" . $category . "')");
            $model_has_category_id = Database::$connection->insert_id;
        }

        Database::iud("INSERT INTO `product`(`price`,`description`,`title`,`datetime_added`, `delivery_fee_colombo`,`delivery_fee_other`,`category_id`,`model_has_category_id`,`status_id`,`users_email`) VALUES('" . $price . "','" . $description . "','" . $title . "','" . $date . "','" . $dwc . "','" . $doc . "','" . $category . "','" . $model_has_category_id . "','" . $status . "','" . $seller_email . "')");

        $product_id = Database::$connection->insert_id;

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        if (isset($_FILES["img1"])) {

            for ($z = 0; $z < 3; $z++) {

                if (isset($_FILES["img" . $z])) {

                    $imagefile = $_FILES["img" . $z];

                    $file_extention = $imagefile["type"];

                    if (in_array($file_extention, $allowed_image_extentions)) {

                        $new_img_extention;

                        if ($file_extention == "image/jpg") {
                            $new_img_extention = ".jpg";
                        } else if ($file_extention == "image/jpeg") {
                            $new_img_extention = ".jpeg";
                        } else if ($file_extention == "image/png") {
                            $new_img_extention = ".png";
                        } else if ($file_extention == "image/svg+xml") {
                            $new_img_extention = ".svg";
                        }

                        $file_name = "resourses//product_img//" . uniqid() . $new_img_extention;
                        move_uploaded_file($imagefile["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES('" . $file_name . "','" . $product_id . "')");

                        if ($z == 2) {
                            echo "success";
                        }
                    } else {

                        echo "Invalid image type.";
                    }
                }
            }
        } else {

            echo "Please add an image.";
        }
    }
}
