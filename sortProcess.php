<?php

session_start();
$user = $_SESSION["a"];

require "connection.php";

$search = $_POST["s"];
$time = $_POST["t"];

$query = "SELECT * FROM `product` WHERE `users_email`='" . $user["email"] . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
} else if ($time == "1") {
    $query .= "ORDER BY `datetime_added` DESC";
} else if ($time == "2") {
    $query .= "ORDER BY `datetime_added` ASC";
}

?>

<div class="row justify-content-center">

    <?php

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $product_rs = Database::search($query);
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    $results_per_page = 6;
    $number_of_pages = ceil($product_num / $results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;
    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");
    $selected_num = $selected_rs->num_rows;

    for ($x = 0; $x < $selected_num; $x++) {
        $selected_data = $selected_rs->fetch_assoc();

    ?>
        <!-- card -->

        <div class="card mb-3 mt-3 col-12 col-lg-6">
            <div class="row">
                <div class="col-md-4 mt-4">

                    <?php

                    $product_img_rs = Database::search("SELECT * FROM `images` WHERE
                                                        `product_id`='" . $selected_data["id"] . "' ");
                    $product_img_data = $product_img_rs->fetch_assoc();

                    ?>

                    <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                        <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span>
                        <br />

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);" />
                            <label class="form-check-label text-info fw-bold" for="flexSwitchCheckDefault<?php echo $selected_data["id"]; ?>" id="switchlbl<?php echo $selected_data["id"]; ?>">

                                <?php
                                if ($selected_data["status_id"] == 2) {
                                    echo "Make Your Product Active";
                                } else {
                                    echo "Make Your Product Deactive";
                                }
                                ?>
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="row g-1">

                                    <div class="col-12 col-lg-6 d-grid">
                                        <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id'] ?>);">Update</button>
                                    </div>
                                    <div class="col-12 col-lg-6 d-grid">
                                        <button class="btn btn-danger fw-bold">Delete</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- card -->
    <?php

    }

    ?>

</div>

<?php

?>