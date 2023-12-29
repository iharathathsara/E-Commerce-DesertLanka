<?php

require "connection.php";

$search_txt = $_POST["t"];
$search_category = $_POST["cat"];

$query = "SELECT * FROM `product`";

if (!empty($search_txt)) {

    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";

    if ($search_category != 0) {
        $query .= "AND `category_id`='" . $search_category . "'";
    }
} else {
    if ($search_category != 0) {
        $query .= "WHERE `category_id`='" . $search_category . "'";
    }
}

if ($_POST["page"] != 0) {

    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

?>

<!--  -->
<div class="col-12 mb-3">
    <div class="row ">
        <div class="col-12 col-lg-12">
            <div class="row justify-content-center gap-4">
                <?php
                while ($results_data = $results_rs->fetch_assoc()) {
                ?>
                    <div class="card col-6 col-lg-2 p-0 mt-2 mb-2 shadow" style="width: 18rem;" data-aos="zoom-in-up" data-aos-duration="1000">
                    <div class="rounded shadow shopProductCard">
                        <?php
                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $results_data["id"] . "'");
                        $image = $imagers->fetch_assoc();
                        ?>
                        <img src="<?php echo $image["code"]; ?>" class="card-img-top card-img-top img-thumbnail" style="height: 200px" />
                        <div class="card-body ms-0 m-0">
                            <h5 class="card-title"><?php echo $results_data["title"]; ?></h5>
                            <span class="card-text text-primary">Rs. <?php echo $results_data["price"]; ?> .00</span>
                            <br />
                            <a href='<?php echo "singleProductView.php?id=" . ($results_data["id"]) ?>' class="btn border border-success col-12 fw-bold buyNowBtn">Buy Now</a>
                            <a onclick="addToCart(<?php echo $results_data['id']; ?>);" class="btn border border-danger col-12 mt-1 addCartBtn">Add to Cart</a>

                            <?php
                            $watchlist_num = 0;
                            if (isset($_SESSION["u"])) {
                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $results_data["id"] . "' AND `users_email`='" . $_SESSION["u"]["email"] . "'");
                                $watchlist_num = $watchlist_rs->num_rows;
                            }
                            if ($watchlist_num == 1) {
                            ?>
                                <a class="btn border border-secondary col-12 mt-1 watchBtn" onclick='addToWatchlist(<?php echo $results_data["id"]; ?>);'>
                                    <i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $results_data["id"]; ?>"></i></a>
                            <?php
                            } else {
                            ?>
                                <a class="btn border border-secondary col-12 mt-1 watchBtn" onclick='addToWatchlist(<?php echo $results_data["id"]; ?>);'>
                                    <i class="bi bi-heart fs-5 text-danger" id="heart<?php echo $results_data["id"]; ?>"></i></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                <?php
                }
                ?>
                <hr class="hr-break-1" />
                <!-- pagi -->
                <div class="offset-lg-4 col-12 col-lg-4 mb-3 text-center">
                    <div class="row">
                        <div class="pagination">
                            <a <?php if ($pageno <= 1) {
                                    echo "#";
                                } else {
                                ?> onclick="basicSearch('<?php echo ($pageno - 1); ?>');" <?php
                                                                                        } ?>>&laquo;</a>
                            <?php
                            for ($page = 1; $page <= $number_of_pages; $page++) {
                                if ($page == $pageno) {
                            ?>
                                    <a onclick="basicSearch('<?php echo ($page); ?>');" class="active">
                                        <?php echo $page; ?>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a onclick="basicSearch('<?php echo ($page); ?>');">
                                        <?php echo $page; ?>
                                    </a>
                            <?php
                                }
                            }
                            ?>
                            <a <?php if ($pageno >= $number_of_pages) {
                                    echo "#";
                                } else {
                                ?> onclick="basicSearch('<?php echo ($pageno + 1); ?>');" <?php
                                                                                        } ?>>&raquo;</a>
                        </div>
                    </div>
                </div>
                <!-- pagi -->
            </div>
        </div>
    </div>
</div>
<!--  -->