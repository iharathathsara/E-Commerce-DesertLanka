<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])) {
    $email = $_SESSION["a"]["email"];

?>
    <!DOCTYPE html>

    <html>

    <head>

        <title>Add Product | Admin | Dessert</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resourses/logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    </head>

    <body style="background-color: #f8f9fa; background-image: linear-gradient(-90deg,#f8f9fa 0%,#ffc107 100% );">

        <div class="container-fluid">
            <div class="row gy-3">

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
                                        <a class="nav-link text-black fs-5 bg-warning active adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
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
                                        <a class="nav-link text-black fs-5 bg-warning active adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
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
                                    <h1 class=" fs-1 text-warning fw-bold">Add New Product</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- header -->

                <div class="col-12 offset-lg-2 col-lg-10">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="row">

                                <div class="col-12 col-lg-6" data-aos="fade-up-right" data-aos-duration="1000">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Category</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" id="category" onchange="selectModel();">
                                                <option value="0">Select Category</option>

                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {

                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6" id="productModelBox" data-aos="fade-up-left" data-aos-duration="1000">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Model</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" id="model">
                                                <option value="0">Select Model</option>

                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for ($z = 0; $z < $model_num; $z++) {

                                                    $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">
                                                Add a title to your Product.
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <input type="text" class="form-control" id="title" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" data-aos="fade-up-right" data-aos-duration="1000">
                                    <div class="row">

                                        <div class="col-12 col-lg-6">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Cost Per Item</label>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" />
                                                    <span class="input-group-text">.00</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12" data-aos="fade-up-right" data-aos-duration="1000">
                                            <label class="form-label fw-bold lbl1">Delivery Costs</label>
                                        </div>

                                        <div class="col-12 col-lg-6" data-aos="fade-up-right" data-aos-duration="1000">
                                            <div class="row">

                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label>Delivery Cost Within Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc" />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6" data-aos="fade-up-left" data-aos-duration="1000">
                                            <div class="row">

                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label>Delivery Cost Out Of Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc" />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                            <label class="form-label fw-bold lbl1">Product Description</label>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                            <textarea class="form-control" cols="30" rows="15" id="description"></textarea>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                            <label class="form-label fw-bold lbl1">Add Product Images</label>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="row">
                                                <div class="col-4 border border-primary rounded">
                                                    <img class="img-fluid" src="resourses/addproductimg.svg" id="preview0" style="width: 250px;" />
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img class="img-fluid" src="resourses/addproductimg.svg" id="preview1" style="width: 250px;" />
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img class="img-fluid" src="resourses/addproductimg.svg" id="preview2" style="width: 250px;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 offset-lg-3 col-lg-6 d-grid mt-3" data-aos="fade-up" data-aos-duration="1000">
                                            <input type="file" accept="img/*" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Image</label>
                                        </div>

                                    </div>
                                </div>

                                <hr class="hr-break-1 my-4" />

                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-2" data-aos="fade-up" data-aos-duration="1000">
                                    <button class="btn btn-success fw-bold" onclick="addproduct();">Add Product</button>
                                </div>

                            </div>
                        </div>

                        <?php require "footer.php"; ?>

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
    header("location:adminSignin.php");
}

?>