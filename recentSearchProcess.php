<?php
session_start();
require "connection.php";
$txt = $_POST["txt"];

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

?>

    <?php

    $recent_rs = Database::search("SELECT `recent`.`id`,`recent`.`product_id` FROM `recent` INNER JOIN `product` ON `recent`.`product_id`=`product`.`id` WHERE `recent`.`users_email`='" . $uemail . "' AND `product`.`title` LIKE '%" . $txt . "%'");
    $recent_num = $recent_rs->num_rows;

    if ($recent_num == 0) {

    ?>
        <!-- no items -->
        <div class="row">
            <div class="col-12 emptyRecentView"></div>
            <div class="col-12 text-center">
                <label class="form-label fs-1 fw-bold">
                    You have no recent items yet.
                </label>
            </div>
        </div>
        <!-- no items -->
    <?php

    } else {

    ?>
        <!-- have products -->
        <div class="row g-2">
            <?php

            for ($x = 0; $x < $recent_num; $x++) {

                $recent_data = $recent_rs->fetch_assoc();
                $product_id = $recent_data["product_id"];

                // search product
                $product_rs = Database::search("SELECT `images`.`code`,`product`.`title`,`product`.`price` FROM `product`
                                                INNER JOIN `images` ON `images`.`product_id`=`product`.`id` 
                                                WHERE `product`.`id`='" . $product_id . "'");
                $product_data = $product_rs->fetch_assoc();

            ?>

                <div class="card mb-3 mx-0 mx-lg-2 col-12">
                    <div class="row g-0">

                        <div class="col-md-4 d-flex align-items-center">
                            <img src="<?php echo $product_data["code"] ?>" class="img-fluid rounded-start" />
                        </div>

                        <div class="col-md-5">
                            <div class="card-body">
                                <h5 class="card-title fw-bold fs-2 text-success"><?php echo $product_data["title"]; ?></h5>
                                <br />
                                <span class="fs-5 fw-bold text-black-50">Price : </span>&nbsp;&nbsp;
                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                <br />
                                <span class="fs-5 fw-bold text-black-50">Description : </span>&nbsp;&nbsp;
                                <span class="fs-5 text-black-50">Rs. <?php echo $product_data["description"]; ?> .00</span>
                            </div>
                        </div>

                        <div class="col-md-3 mt-5">
                            <div class="card-body d-lg-grid">
                                <a href='<?php echo "singleProductView.php?id=" . ($product_id) ?>' class="btn btn-outline-success mb-2">Buy Now</a>
                                <a class="btn btn-outline-danger" onclick="removeFromRecent(<?php echo $recent_data['id']; ?>);">Remove</a>
                            </div>
                        </div>

                    </div>
                </div>

            <?php

            }
            ?>
        </div>
        <!-- have products -->
    <?php
    }
    ?>

<?php
}
?>