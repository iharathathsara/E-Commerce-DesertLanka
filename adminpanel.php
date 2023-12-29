<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {
    $email = $_SESSION["a"]["email"];
?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Admin Panel | Dessert</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resourses/logo.png" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    </head>

    <body style="background-color: #f8f9fa; background-image: linear-gradient(-90deg,#f8f9fa 0%,#ffc107 100% );" onload="reload();">

        <div class="container-fluid">
            <div class="row">

                <!-- nav -->

                <div class="d-none d-lg-block col-lg-2 position-fixed" data-aos="fade-up-right" data-aos-duration="1000">
                    <div class="row">

                        <div class="align-items-start bg-dark col-12" style="height: 100vh;">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5" data-aos="zoom-in" data-aos-duration="1000">
                                    <?php
                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $email . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;
                                    if ($profile_img_num == 1) {
                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resourses/profile_img/newuser.svg" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-12 mt-3" data-aos="zoom-in" data-aos-duration="1500">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                                </div>
                                <div class="col-12 mt-1" data-aos="zoom-in" data-aos-duration="2000">
                                    <span class="text-white"><?php echo $_SESSION["a"]["email"]; ?></span>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" data-aos="zoom-in" data-aos-duration="2000">
                                    <nav class="nav flex-column">
                                        <a class="nav-link fs-5 active text-black bg-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="message.php"><i class="bi bi-chat-dots-fill fs-5"></i> Messages</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="sellingHistory.php"><i class="bi bi-bag-fill fs-5"></i> Selling History</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="#" onclick="signout();"><i class="bi bi-box-arrow-right fs-5"></i> Sign Out</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- nav -->
                <div class="col-12 d-lg-none" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row">
                        <div class="align-items-start bg-dark col-12">
                            <div class="row g-1 text-center">
                                <div class="col-12 mt-5" data-aos="zoom-in" data-aos-duration="1000">
                                    <?php
                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $email . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;
                                    if ($profile_img_num == 1) {
                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resourses/profile_img/newuser.svg" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-12 mt-3" data-aos="zoom-in" data-aos-duration="1500">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                                </div>
                                <div class="col-12 mt-1" data-aos="zoom-in" data-aos-duration="2000">
                                    <span class="text-white"><?php echo $_SESSION["a"]["email"]; ?></span>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" data-aos="zoom-in" data-aos-duration="2000">
                                    <nav class="nav flex-column">
                                        <a class="nav-link fs-5 active text-black bg-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="message.php"><i class="bi bi-chat-dots-fill fs-5"></i> Messages</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="sellingHistory.php"><i class="bi bi-bag-fill fs-5"></i> Selling History</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="#" onclick="signout();"><i class="bi bi-box-arrow-right fs-5"></i> Sign Out</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- nav -->
                <!-- header -->
                <div class="offset-lg-2 col-12 col-lg-10 bg-white" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3 text-center">
                                    <h1 class=" fs-1 text-warning fw-bold">Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="singleBox"></div>
                    </div>
                </div>
                <!-- header -->
                <div class="offset-lg-2 col-12 col-lg-10">
                    <div class="row">
                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                            <hr />
                        </div>
                        <div class="col-12" data-aos="flip-up" data-aos-duration="1000">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-1">
                                    <label class="form-label fs-5 fw-bold">Total Active Time</label>
                                </div>

                                <div class="col-12 col-lg-10 text-end my-1" id="time">
                                    <!-- time -->
                                </div>
                            </div>
                        </div>

                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                            <hr />
                        </div>

                        <?php
                        $conform_rs = Database::search("SELECT COUNT(status) AS `items` FROM `invoice` WHERE `status`= '0'");
                        $conform_data = $conform_rs->fetch_assoc();

                        $packing_rs = Database::search("SELECT COUNT(status) AS `items` FROM `invoice` WHERE `status`= '1'");
                        $packing_data = $packing_rs->fetch_assoc();

                        $dispatch_rs = Database::search("SELECT COUNT(status) AS `items` FROM `invoice` WHERE `status`= '2'");
                        $dispatch_data = $dispatch_rs->fetch_assoc();

                        $shipping_rs = Database::search("SELECT COUNT(status) AS `items` FROM `invoice` WHERE `status`= '3'");
                        $shipping_data = $shipping_rs->fetch_assoc();

                        $dilever_rs = Database::search("SELECT COUNT(status) AS `items` FROM `invoice` WHERE `status`= '4'");
                        $dilever_data = $dilever_rs->fetch_assoc();
                        ?>

                        <div class="col-12 offset-lg-2 col-lg-10">
                            <div class="row gy-2">

                                <div class="col-6 col-lg-2" data-aos="flip-down" data-aos-duration="1000">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger bg-opacity-50 border-danger border-5 border-top text-center rounded" style="height: 200px;">
                                            <br />
                                            <span class="fs-5 fw-bold">Conform</span>
                                            <br />
                                            <h1 class="fw-bold" style="font-size: 64px;"><?php echo $conform_data["items"]; ?></h1>
                                            <span class="fs-5">Orders</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-2" data-aos="flip-down" data-aos-duration="1500">
                                    <div class="row g-1">
                                        <div class="col-12 bg-warning bg-opacity-50 border-warning border-5 border-top text-center rounded" style="height: 200px;">
                                            <br />
                                            <span class="fs-5 fw-bold">Packing</span>
                                            <br />
                                            <h1 class="fw-bold" style="font-size: 64px;"><?php echo $packing_data["items"]; ?></h1>
                                            <span class="fs-5">Orders</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-2" data-aos="flip-down" data-aos-duration="2000">
                                    <div class="row g-1">
                                        <div class="col-12 bg-info bg-opacity-50 border-info border-5 border-top text-center rounded" style="height: 200px;">
                                            <br />
                                            <span class="fs-5 fw-bold">Dispatch</span>
                                            <br />
                                            <h1 class="fw-bold" style="font-size: 64px;"><?php echo $dispatch_data["items"]; ?></h1>
                                            <span class="fs-5">Orders</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-2" data-aos="flip-down" data-aos-duration="2500">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 border-primary border-5 border-top text-center rounded" style="height: 200px;">
                                            <br />
                                            <span class="fs-5 fw-bold">Shipping</span>
                                            <br />
                                            <h1 class="fw-bold" style="font-size: 64px;"><?php echo $shipping_data["items"]; ?></h1>
                                            <span class="fs-5">Orders</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-2" data-aos="flip-down" data-aos-duration="3000">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success bg-opacity-50 border-success border-5 border-top text-center rounded" style="height: 200px;">
                                            <br />
                                            <span class="fs-5 fw-bold">Deliver</span>
                                            <br />
                                            <h1 class="fw-bold" style="font-size: 64px;"><?php echo $dilever_data["items"]; ?></h1>
                                            <span class="fs-5">Orders</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row g-1">

                                <?php

                                $today = date("Y-m-d");
                                $thismonth = date("m");
                                $thisyear = date("Y");

                                $a = "0";
                                $b = "0";
                                $c = "0";
                                $e = "0";
                                $f = "0";

                                $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                $invoice_num = $invoice_rs->num_rows;

                                for ($x = 0; $x < $invoice_num; $x++) {
                                    $invoice_data = $invoice_rs->fetch_assoc();

                                    $f = $f + $invoice_data["qty"]; //total qty

                                    $d = $invoice_data["date"];
                                    $splitDate = explode(" ", $d); //separate date from time
                                    $pdate = $splitDate[0]; //sold date

                                    if ($pdate == $today) {
                                        $a = $a + $invoice_data["total"];
                                        $c = $c + $invoice_data["qty"];
                                    }

                                    $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                    $pyear = $splitMonth[0]; //year
                                    $pmonth = $splitMonth[1]; //month

                                    if ($pyear == $thisyear) {
                                        if ($pmonth == $thismonth) {
                                            $b = $b + $invoice_data["total"];
                                            $e = $e + $invoice_data["qty"];
                                        }
                                    }
                                }
                                ?>



                                <div class="col-6 col-lg-4 px-1" data-aos="flip-left" data-aos-duration="1000">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 border-primary border-5 border-start text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1" data-aos="flip-left" data-aos-duration="1400">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success bg-opacity-50 border-success border-5 border-start text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1" data-aos="flip-left" data-aos-duration="1800">
                                    <div class="row g-1">
                                        <div class="col-12 bg-warning bg-opacity-50 border-warning border-5 border-start text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1" data-aos="flip-left" data-aos-duration="2200">
                                    <div class="row g-1">

                                        <div class="col-12 bg-danger bg-opacity-50 border-danger border-5 border-start text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1" data-aos="flip-left" data-aos-duration="2600">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white bg-opacity-50 border-white border-5 border-start text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1" data-aos="flip-left" data-aos-duration="3000">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark bg-opacity-50 border-dark border-5 border-start text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Members</span>
                                            <br />

                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `users`");
                                            $user_num = $user_rs->num_rows;

                                            ?>

                                            <span class="fs-5"><?php echo ($user_num); ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                            <hr />
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded shadow bg-body" data-aos="zoom-in-right" data-aos-duration="1000">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-decoration-underline">Mostly Sold Item</label>
                                </div>
                                <?php

                                $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` 
                                FROM `invoice` GROUP BY `product_id` ORDER BY 
                                `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product_id`='" . $freq_data["product_id"] . "'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>

                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <img src="<?php echo $image_data["code"]; ?>" class="img-fluid img-thumbnail rounded-top" style="height: 250px;" />
                                        </div>
                                    </div>
                                    <div class="col-12 text-center pb-2">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> Items</span><br />
                                        <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span>
                                    </div>

                                <?php

                                } else {
                                ?>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-2">no items</span><br />
                                    </div>

                                <?php
                                }

                                ?>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded shadow bg-body" data-aos="zoom-in-left" data-aos-duration="1000">
                            <div class="row g-1">
                                <?php

                                $buyer_rs = Database::search("SELECT `user_email`,COUNT(`user_email`) AS `buyer` 
                                    FROM `invoice` GROUP BY `user_email` ORDER BY 
                                   `buyer` DESC LIMIT 1");
                                $buyer_num = $buyer_rs->num_rows;
                                $buyer_data = $buyer_rs->fetch_assoc();

                                if ($buyer_num > 0) {


                                    $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE 
                                    `users_email`='" . $buyer_data["user_email"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    $user_rs1 = Database::search("SELECT * FROM `users` WHERE `email`='" . $buyer_data["user_email"] . "'");
                                    $user_data1 = $user_rs1->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Best Customer</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $user_data1["fname"] . " " . $user_data1["lname"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["email"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["mobile"]; ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Best Customer</label>
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-2">No Customer Yet</span><br />
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>

                        <?php
                        require "footer.php"
                        ?>

                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </body>

    </html>

<?php

} else {

?>
    <script>
        window.location = "adminSignin.php";
    </script>
<?php

}

?>