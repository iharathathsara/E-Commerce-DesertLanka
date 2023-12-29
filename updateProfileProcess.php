<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $line1 = $_POST["li1"];
    $line2 = $_POST["li2"];
    $province = $_POST["pr"];
    $distict = $_POST["di"];
    $city = $_POST["ci"];
    $postal_code = $_POST["pc"];


    if (empty($fname)) {
        echo "*Please Enter First name";
    } else if (empty($lname)) {
        echo "*Please Enter Last name";
    } else if (empty($mobile)) {
        echo "*Please Enter Mobile Number";
    } else if (empty($line1)) {
        echo "*Please Enter Address Line 01";
    } else if (empty($line2)) {
        echo "*Please Enter Address Line 02";
    } else if (empty($province)) {
        echo "*Please Enter Your Province";
    } else if (empty($distict)) {
        echo "*Please Enter Your District";
    } else if (empty($city)) {
        echo "*Please Enter Your City";
    } else if (empty($postal_code)) {
        echo "*Please Enter Your Postal Code";
    } else {

        if (isset($_FILES["image"])) {

            $image = $_FILES["image"];

            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
            $file_ex = $image["type"];

            if (!in_array($file_ex, $allowed_image_extentions)) {

                echo "Please select a valid image.";
            } else {

                $new_image_extention;

                if ($file_ex == "image/jpg") {
                    $new_image_extention = ".jpg";
                } else if ($file_ex == "image/jpeg") {
                    $new_image_extention = ".jpeg";
                } else if ($file_ex == "image/png") {
                    $new_image_extention = ".png";
                } else if ($file_ex == "image/svg+xml") {
                    $new_image_extention = ".svg";
                }

                $file_name = "resourses//profile_img//" . uniqid() . $new_image_extention;

                move_uploaded_file($image["tmp_name"], $file_name);


                $profile_pic_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");

                $profile_pic_num = $profile_pic_rs->num_rows;

                if ($profile_pic_num == 1) {

                    Database::iud("UPDATE `profile_image` SET `path`='" . $file_name . "' WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");
                } else {

                    Database::iud("INSERT INTO `profile_image`(`path`,`users_email`) VALUES('" . $file_name . "','" . $_SESSION["u"]["email"] . "')");
                }
            }
        } else {
        }

        Database::iud("UPDATE `users` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "' ");

        $city_rs = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "' AND `district_id` = '" . $distict . "'");
        $city_num = $city_rs->num_rows;
        $city_id;
        if ($city_num == 1) {
            $city_data = $city_rs->fetch_assoc();
            $city_id = $city_data["id"];
        } else {
            Database::iud("INSERT INTO `city` (`name`,`district_id`) VALUES ('" . $city . "','" . $distict . "')");
            $city_rs1 = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "' AND `district_id` = '" . $distict . "'");
            $city_data = $city_rs1->fetch_assoc();
            $city_id = $city_data["id"];
        }

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $_SESSION["u"]["email"] . "' ");
        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {

            Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "', `city_id`='" . $city_id . "',`postal_code`='" . $postal_code . "' WHERE `users_email`='" . $_SESSION["u"]["email"] . "' ");
        } else {

            Database::iud("INSERT INTO `user_has_address` (`line1`,`line2`,`users_email`,`city_id`,`postal_code`) VALUES('" . $line1 . "','" . $line2 . "','" . $_SESSION["u"]["email"] . "','" . $city_id . "','" . $postal_code . "') ");
        }

        echo "success";
    }
} else {

    echo "Please Log In to your account first.";
}
