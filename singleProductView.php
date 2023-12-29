<?php

require "connection.php";
if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.category_id,product.model_has_category_id,
    product.title,product.price,product.description,product.status_id,
    product.users_email,model.name AS mname FROM product 
    INNER JOIN model_has_category ON model_has_category.id=product.model_has_category_id 
    INNER JOIN model ON model.id=model_has_category.model_id
    WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();


?>

        <!DOCTYPE html>

        <html>

        <head>
            <title>Single Product View | Dessert</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="resourses/logo.png" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />
            <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php
                    require "headder.php";
                    ?>

                    <div class="col-12 mt-0 bg-white singleproduct">
                        <div class="row">

                            <div class="col-12" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-12 offset-lg-1 col-lg-4">
                                        <div class="row">

                                            <div class="col-lg-12 order-2 order-lg-1 ">
                                                <div class="row">

                                                    <div class="col-12 align-items-center">
                                                        <div class="mainImg" id="mainImg">

                                                            <?php
                                                            $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");

                                                            $product_img_num = $product_img_rs->num_rows;
                                                            $img1 = array();
                                                            ?>

                                                            <!-- carsol -->
                                                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-aos="zoom-in-up" data-aos-duration="1000">
                                                                <div class="carousel-inner">
                                                                    <?php
                                                                    for ($a = 0; $a < $product_img_num; $a++) {
                                                                        $imgd = $product_img_rs->fetch_assoc();
                                                                        $img1[$a] = $imgd["code"];
                                                                    }
                                                                    ?>
                                                                    <div class="carousel-item active">
                                                                        <img src="<?php echo $img1["0"]; ?>" class="d-block w-100 img-thumbnail" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="<?php echo $img1["1"]; ?>" class="d-block w-100" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="<?php echo $img1["2"]; ?>" class="d-block w-100" alt="...">
                                                                    </div>
                                                                </div>
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                            <!-- carsol -->

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-12 order-2 order-lg-1">
                                                <div class="row">

                                                    <?php

                                                    $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");

                                                    $product_img_num = $product_img_rs->num_rows;
                                                    $img = array();

                                                    if ($product_img_num != 0) {

                                                        for ($x = 0; $x < $product_img_num; $x++) {

                                                            $product_img_data = $product_img_rs->fetch_assoc();

                                                            $img[$x] = $product_img_data["code"];

                                                    ?>

                                                            <div class="col-4 d-flex justify-content-center align-items-center mb-1" data-aos="zoom-in-up" data-aos-duration="1000">
                                                                <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-1 mb-1" style="width: 100%; cursor: pointer;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                            </div>

                                                        <?php

                                                        }
                                                    } else {

                                                        ?>

                                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                            <img src="resourses/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                        </li>

                                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                            <img src="resourses/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                        </li>

                                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                            <img src="resourses/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                        </li>

                                                    <?php

                                                    }

                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 offset-lg-1 col-lg-4 order-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row border-bottom border-dark" data-aos="zoom-in-up" data-aos-duration="1000">

                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">
                                                                Single Product View
                                                            </li>
                                                        </ol>
                                                    </nav>

                                                </div>

                                                <div class="row  border-bottom border-dark" data-aos="zoom-in-up" data-aos-duration="1000">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-capitalize text-success"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark" data-aos="zoom-in-up" data-aos-duration="1000">
                                                    <div class="col-12 my2">

                                                        <?php

                                                        $price = $product_data["price"];
                                                        $addingPrice = ($price / 100) * 5;
                                                        $newPrice = $price + $addingPrice;
                                                        $difference = $newPrice - $price;
                                                        $precentage = ($difference / $price) * 100;

                                                        ?>

                                                        <span id="unitPrice" class="fs-4 fw-bold text-black">Rs. <?php echo $price; ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-danger"><del>Rs. <?php echo $newPrice; ?> .00</del></span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">Save Rs. <?php echo $difference; ?> .00 (<?php echo $precentage; ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 fs-3" data-aos="zoom-in-up" data-aos-duration="1000">
                                                        <span class="fs-5">Description :</span>
                                                        <span><?php echo $product_data["description"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-3" data-aos="zoom-in-up" data-aos-duration="1000">
                                                                <div class="row g-2">
                                                                    <span>Quantity : </span>
                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                        <div class="col-12">

                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_value();' id="qtyInput" />
                                                                            <div class="position-absolute qty_buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                    <i class="bi bi-caret-up text-info fs-5" onclick='qty_inc();'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                    <i class="bi bi-caret-down text-info fs-5" onclick='qty_dec();'></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 mt-5">
                                                        <div class="row">
                                                            <div class="col-4 d-grid" data-aos="zoom-in-up" data-aos-duration="1000">
                                                                <button onclick="buyNow(<?php echo $pid; ?>);" class="btn border-success buyNowBtn">Buy Now</button>
                                                            </div>
                                                            <div class="col-4 d-grid" data-aos="zoom-in-up" data-aos-duration="1000">
                                                                <button class="btn border-danger addCartBtn" onclick="addToCart(<?php echo $pid; ?>);">Add to Cart</button>
                                                            </div>
                                                            <div class="col-4 d-grid" data-aos="zoom-in-up" data-aos-duration="1000">

                                                                <?php
                                                                $watchlist_num = 0;
                                                                if (isset($_SESSION["u"])) {

                                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' AND `users_email`='" . $_SESSION["u"]["email"] . "'");
                                                                    $watchlist_num = $watchlist_rs->num_rows;
                                                                }

                                                                if ($watchlist_num == 1) {

                                                                ?>
                                                                    <button class="btn btn-outline-secondary watchBtn" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                        <i class="bi bi-heart-fill fs-4 text-danger" id="heart<?php echo $pid; ?>"></i>
                                                                    </button>

                                                                <?php

                                                                } else {

                                                                ?>

                                                                    <button class="btn btn-outline-secondary watchBtn" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                        <i class="bi bi-heart-fill fs-4 text-black" id="heart<?php echo $pid; ?>"></i>
                                                                    </button>

                                                                <?php

                                                                }

                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                    <?php
                    require "footer.php";
                    ?>

                </div>
            </div>

            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script>
                AOS.init();
            </script>
        </body>

        </html>

<?php

    } else {
        echo "Sorry for the inconvenient.";
    }
} else {
    echo "Something went wrong.";
}

?>