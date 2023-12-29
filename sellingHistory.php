<?php
session_start();
require "connection.php";
if (isset($_SESSION["a"])) {
    $email = $_SESSION["a"]["email"];

?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <title>Selling History | Admin | Dessert</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link rel="icon" href="resourses/logo.png" />
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
                                        <a class="nav-link text-warning fs-5 adminNav" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="message.php"><i class="bi bi-chat-dots-fill fs-5"></i> Messages</a>
                                        <a class="nav-link text-black fs-5 active bg-warning adminNav" href="sellingHistory.php"><i class="bi bi-bag-fill fs-5"></i> Selling History</a>
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
                                        <a class="nav-link fs-5 text-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="message.php"><i class="bi bi-chat-dots-fill fs-5"></i> Messages</a>
                                        <a class="nav-link text-black fs-5 active bg-warning adminNav" href="sellingHistory.php"><i class="bi bi-bag-fill fs-5"></i> Selling History</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="#" onclick="signout();"><i class="bi bi-box-arrow-right fs-5"></i> Sign Out</a>
                                    </nav>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <!-- nav -->

                <div class="offset-lg-2 col-12 col-lg-10">
                    <div class="row">

                        <!-- header -->
                        <div class="col-12 bg-white" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3 text-center">
                                    <h1 class=" fs-1 text-warning fw-bold">Selling History</h1>
                                </div>
                            </div>
                        </div>
                        <!-- header -->

                        <div class="col-12 mt-3 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-3 mt-3 mb-3" data-aos="zoom-in-up" data-aos-duration="1000">
                                    <label class="form-label fs-5">Search by Invoice ID :</label>
                                    <input type="text" class="form-control fs-5" id="searchtxt" onkeyup="searchInvoiceId();" />
                                </div>

                                <div class="col-12 col-lg-2 mt-3 mb-3"></div>

                                <div class="col-12 col-lg-3 mt-3 mb-3" data-aos="zoom-in-up" data-aos-duration="1000">
                                    <label class="form-label fs-5">From Date :</label>
                                    <input type="date" class="form-control fs-5" id="from" />
                                </div>

                                <div class="col-12 col-lg-3 mt-3 mb-3" data-aos="zoom-in-up" data-aos-duration="1000">
                                    <label class="form-label fs-5">To Date :</label>
                                    <input type="date" class="form-control fs-5" id="to" />
                                </div>

                                <div class="col-12 col-lg-1 mt-5 mb-3 d-grid" data-aos="zoom-in-up" data-aos-duration="1000">
                                    <button class="btn btn-warning fs-5 fw-bold" onclick="findSellings();">Find</button>
                                </div>

                            </div>
                        </div>

                        <div class="col-12" data-aos="zoom-in-down" data-aos-duration="1000">
                            <div class="row">

                                <div class="col-1">
                                    <label class="form-label fs-6 fw-bold">Invoice Id</label>
                                </div>

                                <div class="col-2 text-center">
                                    <label class="form-label fs-5 fw-bold">Product</label>
                                </div>

                                <div class="col-2 text-center">
                                    <label class="form-label fs-5 fw-bold">Buyer</label>
                                </div>

                                <div class="col-2 text-center">
                                    <label class="form-label fs-5 fw-bold">Date</label>
                                </div>

                                <div class="col-2 text-end">
                                    <label class="form-label fs-5 fw-bold">Amount</label>
                                </div>

                                <div class="col-1 text-center">
                                    <label class="form-label fs-5 fw-bold ">Quantity</label>
                                </div>

                                <div class="col-2"></div>

                            </div>
                        </div>

                        <div class="col-12 mt-2" id="viewArea">
                            <?php

                            $query = "SELECT * FROM `invoice` ORDER BY `date` DESC";
                            $pageno;


                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $invoice_rs = Database::search($query);
                            $invoice_num = $invoice_rs->num_rows;

                            $results_per_page = 20;
                            $number_of_pages = ceil($invoice_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                            $selected_num = $selected_rs->num_rows;

                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();

                            ?>

                                <div class="row" data-aos="fade-up" data-aos-duration="1000">

                                    <div class="col-1 border text-center">
                                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $selected_data["id"]; ?></label>
                                    </div>

                                    <div class="col-2 border">

                                        <?php
                                        $pid = $selected_data["product_id"];

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        ?>

                                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                                    </div>

                                    <?php

                                    ?>
                                    <div class="col-2 border" data-bs-toggle="modal" data-bs-target="#feedback<?php echo $selected_data["id"]; ?>">

                                        <?php
                                        $uemail = $selected_data["user_email"];

                                        $buyer_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $uemail . "'");
                                        $buyer_data = $buyer_rs->fetch_assoc();
                                        ?>

                                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></label>

                                    </div>

                                    <div class="col-2 border text-end">
                                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $selected_data["date"]; ?></label>
                                    </div>

                                    <div class="col-2 border text-end">
                                        <label class="form-label fs-6 fw-bold mt-1 mb-1">Rs. <?php echo $selected_data["total"]; ?> .00</label>
                                    </div>

                                    <div class="col-1 border text-center">
                                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $selected_data["qty"]; ?></label>
                                    </div>

                                    <div class="col-2 border d-grid">

                                        <?php

                                        if ($selected_data["status"] == 0) {
                                        ?>
                                            <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btn<?php echo $selected_data['id']; ?>">Confirm Order</button>
                                        <?php
                                        } else if ($selected_data["status"] == 1) {
                                        ?>
                                            <button class="btn btn-warning fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btn<?php echo $selected_data['id']; ?>">Packing</button>
                                        <?php
                                        } else  if ($selected_data["status"] == 2) {
                                        ?>
                                            <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btn<?php echo $selected_data['id']; ?>">Dispatch</button>
                                        <?php
                                        } else  if ($selected_data["status"] == 3) {
                                        ?>
                                            <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btn<?php echo $selected_data['id']; ?>">Shipping</button>
                                        <?php
                                        } else  if ($selected_data["status"] == 4) {
                                        ?>
                                            <button class="btn btn-danger fw-bold mt-1 mb-1 disabled" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btn<?php echo $selected_data['id']; ?>">Delivered</button>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <?php
                                $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `invoice_id` = '" . $selected_data["id"] . "' ");
                                $feedback_num = $feedback_rs->num_rows;

                                if ($feedback_num == 0) {
                                ?>
                                    <div class="modal fade" id="feedback<?php echo $selected_data["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>No Feedback</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                } else {
                                    $feedback_data = $feedback_rs->fetch_assoc();
                                ?>
                                    <div class="modal fade" id="feedback<?php echo $selected_data["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5><?php echo $feedback_data["feedback"]; ?></h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>




                            <?php
                            }

                            ?>

                            <!--  -->
                            <div class="offset-2 offset-lg-5 col-8 col-lg-2 text-center mb-3 mt-3" data-aos="fade-up" data-aos-duration="1000">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-lg justify-content-center d-inline">
                                        <li class="page-item">
                                            <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                            echo ("#");
                                                                        } else {
                                                                            echo "?page=" . ($pageno - 1);
                                                                        } ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php

                                        for ($x = 1; $x <= $number_of_pages; $x++) {
                                            if ($x == $pageno) {
                                        ?>
                                                <li class="page-item active">
                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                </li>
                                        <?php
                                            }
                                        }

                                        ?>

                                        <li class="page-item">
                                            <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                            echo ("#");
                                                                        } else {
                                                                            echo "?page=" . ($pageno + 1);
                                                                        } ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!--  -->
                        </div>
                        <?php
                        require "footer.php";
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
        <script src="bootstrap.bundle.js"></script>
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