<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {
    $txt = $_GET["txt"];

?>
    <div class="row">

        <?php
        $page_no;
        if (isset($_GET["page"])) {
            $page_no = $_GET["page"];
        } else {
            $page_no = 1;
        }
        $product_rs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $txt . "%'");
        $product_num = $product_rs->num_rows;
        $result_per_page = 10;
        $number_of_page = ceil($product_num / $result_per_page);
        $page_first_result = ((int)$page_no - 1) * $result_per_page;
        $view_product_rs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $txt . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
        $view_result_num = $view_product_rs->num_rows;
        $c = 0;
        ?>

        <?php
        while ($product_data = $view_product_rs->fetch_assoc()) {

            $c = $c + 1;
        ?>
            <div class="col-12">
                <div class="row">
                    <div class="col-2 col-lg-1 border py-2 text-end">
                        <span class="fs-6 fw-bold"><?php echo $product_data["id"]; ?></span>
                    </div>
                    <?php
                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                    $image_data = $image_rs->fetch_assoc();
                    ?>
                    <div class="col-2 border py-2 d-none d-lg-block" onclick="viewProductModal(<?php echo $product_data['id']; ?>);">
                        <img src="<?php echo $image_data["code"]; ?>" style="height: 40px; margin-left: 50px;" />
                    </div>
                    <div class="col-4 col-lg-2 border py-2">
                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span>
                    </div>
                    <div class="col-4 col-lg-2 border py-2 d-lg-block">
                        <span class="fs-5 fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span>
                    </div>
                    <?php
                    $category_rs = Database::search("SELECT `category`.`name` FROM `product` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` WHERE `product`.`id`='" . $product_data["id"] . "'");
                    $category_data = $category_rs->fetch_assoc();
                    ?>
                    <div class="col-2 border py-2 d-none d-lg-block">
                        <span class="fs-5 fw-bold"><?php echo $category_data["name"] ?></span>
                    </div>
                    <div class="col-2 border py-2 d-none d-lg-block">
                        <span class="fs-6 fw-bold">
                            <?php
                            $row = $product_data["datetime_added"];
                            $splited = explode(" ", $row);
                            echo $splited[0];
                            ?>
                        </span>
                    </div>
                    <div class="col-2 col-lg-1 border py-2 d-grid">
                        <?php
                        $s = $product_data["status_id"];
                        if ($s == "1") {
                        ?>
                            <button id="pb<?php echo $product_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Block</button>
                        <?php
                        } else {
                        ?>
                            <button id="pb<?php echo $product_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Unblock</button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- model 1 -->
            <div class="modal" tabindex="-1" id="viewproductmodal<?php echo $product_data['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo $product_data["title"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="offset-lg-4 col-4">
                                <img src="<?php echo $image_data["code"]; ?>" style="height: 150px;" class="img-fluid" />
                            </div>
                            <div class="col-12">
                                <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                <span class="fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                                <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                <?php
                                $seller_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $product_data["users_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                ?>
                                <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br />
                                <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                <span class="fs-5"><?php echo $product_data["description"]; ?></span><br />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 1 -->
        <?php
        }
        ?>

        <!-- pagination -->
        <div class="col-12 text-center">
            <div class="pagination">
                <a href="<?php if ($page_no <= 1) {
                                echo "#";
                            } else {
                                echo "?page=" . ($page_no - 1);
                            } ?>">&laquo;</a>
                <?php
                for ($page = 1; $page <= $number_of_page; $page++) {
                    if ($page == $page_no) {
                ?>
                        <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>
                        <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page ?></a>
                <?php
                    }
                }
                ?>
                <a href="<?php if ($page_no >= $number_of_page) {
                                echo "#";
                            } else {
                                echo "?page=" . ($page_no + 1);
                            } ?>">
                    &raquo;</a>
            </div>
        </div>
        <!-- pagination -->

    </div>

<?php

} else {
    header("location:adminSignin.php");
}
?>