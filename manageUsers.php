<?php

session_start();
require "connection.php";
if (isset($_SESSION["a"])) {
    $admin = $_SESSION["a"]["email"];

?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <title>Manage Users | Admin | Dessert</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link rel="icon" href="resourses/logo.png" />
    </head>

    <body style="background-color: #f8f9fa; background-image: linear-gradient(-90deg,#f8f9fa 0%,#ffc107 100% );" onload="adminMsgViewReload();">

        <div class="container-fluid">
            <div class="row">

                <!-- nav -->

                <div class="d-none d-lg-block col-lg-2 position-fixed" data-aos="fade-up-right" data-aos-duration="1000">
                    <div class="row">

                        <div class="align-items-start bg-dark col-12" style="height: 100vh;">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5" data-aos="zoom-in" data-aos-duration="1000">
                                    <?php

                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $admin . "'");
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
                                        <a class="nav-link text-black active bg-warning fs-5  adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
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

                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $admin . "'");
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
                                        <a class="nav-link text-black active adminNav bg-warning fs-5" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
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
                                    <h1 class=" fs-1 text-warning fw-bold">Manage Users</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- header -->

                <div class="offset-lg-2 col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12 mt-3" data-aos="zoom-in-up" data-aos-duration="1000">
                            <div class="row">
                                <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" id="userTxt" class="form-control" />
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button class="btn btn-warning" onclick="manageUserSearch();">Search User</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 mb-1" data-aos="zoom-in-down" data-aos-duration="1000">
                            <div class="row">
                                <div class="col-2 col-lg-1 py-2 text-end">
                                    <span class="fs-5 fw-bold">#</span>
                                </div>
                                <div class="col-1 d-none d-lg-block py-2">
                                    <span class="fs-5 fw-bold">Profile Image</span>
                                </div>
                                <div class="col-4 col-lg-2 py-2">
                                    <span class="fs-5 fw-bold">User Name</span>
                                </div>
                                <div class="col-4 col-lg-3 d-lg-block py-2">
                                    <span class="fs-5 fw-bold">Email</span>
                                </div>
                                <div class="col-2 d-none d-lg-block py-2">
                                    <span class="fs-5 fw-bold">Mobile</span>
                                </div>
                                <div class="col-2 d-none d-lg-block py-2">
                                    <span class="fs-5 fw-bold">Registered Date</span>
                                </div>
                                <div class="col-2 col-lg-1"></div>
                            </div>
                        </div>

                        <div class="col-12" id="userSearchResult">
                            <div class="row">

                                <?php

                                $query = "SELECT * FROM `users`";
                                $pageno;


                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $user_rs = Database::search($query);
                                $user_num = $user_rs->num_rows;

                                $results_per_page = 10;
                                $number_of_pages = ceil($user_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page;
                                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>

                                    <div class="col-12" data-aos="zoom-in-up" data-aos-duration="1000">
                                        <div class="row">
                                            <div class="col-2 col-lg-1 border py-2 text-end">
                                                <span class="fs-6 fw-bold"><?php echo $x + 1; ?></span>
                                            </div>
                                            <?php
                                            $user_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $selected_data["email"] . "'");
                                            $userImg_num = $user_image_rs->num_rows;
                                            if ($userImg_num == 0) {
                                            ?>
                                                <div class="col-1 d-none d-lg-block border py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>','<?php echo $x; ?>');" style="cursor: pointer;">
                                                    <img src="resourses/profile_img/newuser.svg" style="height: 40px; margin-left: 20px;" />
                                                </div>
                                            <?php
                                            } else {
                                                $userImg_data = $user_image_rs->fetch_assoc();

                                            ?>
                                                <div class="col-1 d-none d-lg-block border py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>','<?php echo $x; ?>');" style="cursor: pointer;">
                                                    <img src="<?php echo $userImg_data["path"] ?>" style="height: 40px; margin-left: 20px;" />
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-4 col-lg-2 border py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>','<?php echo $x; ?>');" style="cursor: pointer;">
                                                <span class="fs-6 fw-bold"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                                            </div>
                                            <div class="col-4 col-lg-3 d-lg-block border py-2">
                                                <span class="fs-6 fw-bold"><?php echo $selected_data["email"] ?></span>
                                            </div>
                                            <div class="col-2 d-none d-lg-block border py-2">
                                                <span class="fs-6 fw-bold"><?php echo $selected_data["mobile"] ?></span>
                                            </div>
                                            <div class="col-2 d-none d-lg-block border py-2">
                                                <span class="fs-6 fw-bold"><?php echo $selected_data["joined_date"] ?></span>
                                            </div>
                                            <div class="col-2 col-lg-1 border py-2 d-grid">
                                                <?php

                                                if ($selected_data["status"] == 1) {
                                                ?>
                                                    <button class="btn btn-danger" id="ub<?php echo $selected_data['email']; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn btn-success" id="ub<?php echo $selected_data['email']; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- msg modal -->
                                    <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Send Message to <?php echo $selected_data['fname'] . " " . $selected_data["lname"]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" id="msgtxt<?php echo $x; ?>" placeholder="type..." />
                                                            </div>
                                                            <div class="col-3 d-grid">
                                                                <button type="button" class="btn btn-primary" onclick="sendAdminMsg('<?php echo $selected_data['email'] ?>','msgtxt<?php echo $x; ?>')">Send</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- msg modal -->

                                <?php

                                }

                                ?>

                                <!--  -->
                                <div class="offset-2 offset-lg-5 col-8 col-lg-4 mt-3 mb-3" data-aos="fade-up" data-aos-duration="1000">
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
                        </div>

                        <?php
                        require "footer.php"
                        ?>

                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
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