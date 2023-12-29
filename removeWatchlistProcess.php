<?php

require "connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `id`='" . $id . "'");
    $watch_num = $watch_rs->num_rows;

    if ($watch_num == 0) {
        echo "Something went wrong. Please try again later.";
    } else {
        Database::iud("DELETE FROM `watchlist` WHERE `id`='" . $id . "'");
        echo "success";
    }
} else {
    echo "Please select a product";
}
