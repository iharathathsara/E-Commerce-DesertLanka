<?php
session_start();
require "connection.php";
if (isset($_SESSION["a"])) {
    $email = $_SESSION["a"]["email"];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Manage Products | Admin | Desert</title>

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
                                        <a class="nav-link text-black fs-5 active bg-warning adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
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
                                        <a class="nav-link text-black fs-5 active bg-warning adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
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
                                    <h1 class=" fs-1 text-warning fw-bold">Manage All Products</h1>
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
                                <div class="offset-lg-2 col-12 col-lg-8 mb-3">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="producttxt" />
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button class="btn btn-warning" onclick="manageproductSearch();">Search Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 mb-3" data-aos="zoom-in-down" data-aos-duration="1000">
                            <div class="row">
                                <div class="col-2 col-lg-1 py-2 text-end">
                                    <span class="fs-5 fw-bold">#</span>
                                </div>
                                <div class="col-2 py-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold">Product Image</span>
                                </div>
                                <div class="col-4 col-lg-2 py-2">
                                    <span class="fs-5 fw-bold">Title</span>
                                </div>
                                <div class="col-4 col-lg-2 py-2">
                                    <span class="fs-5 fw-bold">Price</span>
                                </div>
                                <div class="col-2 py-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold">Category</span>
                                </div>
                                <div class="col-2 py-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold">Registed Date</span>
                                </div>
                                <div class="col-2 col-lg-1"></div>
                            </div>
                        </div>

                        <div class="col-12" id="searchResults">
                            <div class="row">

                                <?php
                                $page_no;
                                if (isset($_GET["page"])) {
                                    $page_no = $_GET["page"];
                                } else {
                                    $page_no = 1;
                                }
                                $product_rs = Database::search("SELECT * FROM `product`");
                                $product_num = $product_rs->num_rows;
                                $result_per_page = 10;
                                $number_of_page = ceil($product_num / $result_per_page);
                                $page_first_result = ((int)$page_no - 1) * $result_per_page;
                                $view_product_rs = Database::search("SELECT * FROM `product` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
                                $view_result_num = $view_product_rs->num_rows;
                                $c = 0;
                                ?>

                                <?php
                                while ($product_data = $view_product_rs->fetch_assoc()) {

                                    $c = $c + 1;
                                ?>
                                    <div class="col-12" data-aos="zoom-in-up" data-aos-duration="1000">
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
                                <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="1000">
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
                        </div>

                        <hr />

                        <!--  -->
                        <div class="col-12 text-center mb-4" data-aos="fade-up" data-aos-duration="1000">
                            <h3 class="text-black-50 fw-bold">Manage Categories</h3>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="row gap-2 justify-content-center">

                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>

                                    <div class="col-12 col-lg-3 border border-danger rounded" style="height: 50px;" data-aos="fade-up" data-aos-duration="1000">
                                        <div class="row">
                                            <div class="col-8 mt-2">
                                                <label class="form-label fw-bold fs-5"><?php echo $category_data["name"]; ?></label>
                                            </div>
                                            <div class="col-4 border-start border-secondary text-center mt-2">
                                                <label class="form-label fs-4" style="cursor: pointer;" onclick="deleteCategory(<?php echo $category_data['id']; ?>);"><i class="bi bi-trash text-danger fs-4"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }

                                ?>


                                <div class="col-12 col-lg-3 border border-success rounded" style="height: 50px;" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="row">
                                        <div class="col-8 mt-2">
                                            <label class="form-label fw-bold fs-5">Add New Category</label>
                                        </div>
                                        <div class="col-4 border-start border-secondary text-center mt-2">
                                            <label class="form-label fs-4"><i class="bi bi-plus-square-fill text-success fs-4" onclick="addNewCategory();" style="cursor: pointer;"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->

                        <!-- modal 2 -->
                        <div class="modal" tabindex="-1" id="addCategoryModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <label class="form-label">New Category Name : </label>
                                            <input type="text" class="form-control" id="n" />
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="form-label">Enter Your Email : </label>
                                            <input type="text" class="form-control" id="e" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal 2 -->
                        <!-- modal 3 -->
                        <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Verification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label">Enter Your Verification Code : </label>
                                            <input type="text" class="form-control" id="txt" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal 3 -->

                        <!-- modal 4 -->
                        <div class="modal" tabindex="-1" id="deleteCategoryModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 mt-2">
                                            <label class="form-label">Enter Your Email : </label>
                                            <input type="text" class="form-control" id="cde" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="verifydeleteCategory();">Delete Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal 4 -->
                        <!-- modal 5 -->
                        <div class="modal" tabindex="-1" id="deleteCategoryVerificationModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Verification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label">Enter Your Verification Code : </label>
                                            <input type="text" class="form-control" id="txt" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="deleteverifyCategory();">Verify & Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal 5 -->

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