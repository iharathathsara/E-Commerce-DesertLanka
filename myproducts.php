<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $pageno;
    $email = $_SESSION["a"]["email"];

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>Desert | My Products</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resourses/logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    </head>

    <body style="background-color: #f8f9fa; background-image: linear-gradient(-90deg,#f8f9fa 0%,#ffc107 100% );">

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
                                        <a class="nav-link fs-5 text-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-black active adminNav bg-warning fs-5" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
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

                <!-- nav -->
                <div class="col-12 d-lg-none" data-aos="zoom-in-up" data-aos-duration="1000">
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
                                        <a class="nav-link fs-5 text-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-black active adminNav bg-warning fs-5" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
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
                                    <h1 class=" fs-1 text-warning fw-bold">My Products</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- header -->

                <!-- body -->
                <div class="offset-lg-2 col-12 col-lg-10">
                    <div class="row">

                        <!-- sort -->
                        <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded" data-aos="fade-up-right" data-aos-duration="1000">
                            <div class="row">

                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12" data-aos="zoom-in" data-aos-duration="400">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>

                                        <div class="col-11" data-aos="zoom-in" data-aos-duration="800">
                                            <div class="row">

                                                <div class="col-10">
                                                    <input type="text" class="form-control" placeholder="Search..." id="s" />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label fs-3 bi bi-search"></label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1200">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>

                                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1600">
                                            <hr width="80%" />
                                        </div>

                                        <div class="col-12" data-aos="zoom-in" data-aos-duration="2000">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n" />
                                                <label class="form-check-label" for="n">
                                                    Newest to Oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="zoom-in" data-aos-duration="2400">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o" />
                                                <label class="form-check-label" for="o">
                                                    Oldest to Newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3" data-aos="zoom-in" data-aos-duration="2600">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-success fw-bold" onclick="sortFunction();">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- sort -->

                        <!-- products -->
                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white" data-aos="fade-up-left" data-aos-duration="1000">
                            <div class="row">

                                <div class="col-10 offset-1 text-center align-self-center" id="sort">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "'");
                                        $product_num = $product_rs->num_rows;
                                        $product_data = $product_rs->fetch_assoc();

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>
                                            <!-- card -->

                                            <div class="card mb-3 mt-3 col-12 col-lg-6" data-aos="zoom-in-up" data-aos-duration="1000">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">

                                                        <?php

                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "' ");
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
                                                                            <button class="btn btn-danger fw-bold" onclick="deleteProduct(<?php echo $selected_data['id']; ?>);">Delete</button>
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
                                </div>

                                <!-- pagination -->

                                <div class="offset-2 offset-lg-4 col-8 col-lg-4 text-center mb-3 " data-aos="zoom-in-up" data-aos-duration="1000">

                                    <div class="pagination">
                                        <a href="
                                        <?php
                                        if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }
                                        ?>
                                        ">&laquo;</a>

                                        <?php
                                        for ($page = 1; $page <= $number_of_pages; $page++) {

                                            if ($page == $pageno) {

                                        ?>
                                                <a href="<?php echo "?page=" . ($page) ?>" class="active"><?php echo $page ?></a>
                                            <?php

                                            } else {
                                            ?>
                                                <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page ?></a>
                                        <?php
                                            }
                                        }
                                        ?>


                                        <a href="
                                        <?php
                                        if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }
                                        ?>
                                        ">&raquo;</a>
                                    </div>

                                </div>

                                <!-- pagination -->

                            </div>
                        </div>
                        <!-- products -->

                        <?php
                        require "footer.php";
                        ?>

                    </div>
                </div>
                <!-- body -->



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
    header("location:adminSignin.php");
}

?>