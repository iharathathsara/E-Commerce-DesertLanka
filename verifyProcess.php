<?php

session_start();

require "connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `code`='" . $id . "'");

    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {

        $admin_data = $admin_rs->fetch_assoc();
        $admin_full_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $admin_data["email"] . "'");
        $admin_full_data = $admin_full_rs->fetch_assoc();

        $_SESSION["a"] = $admin_full_data;

        echo "success";
    } else {
        echo "Verification code is not valid";
    }
} else {
    echo "Please enter your verification code";
}
