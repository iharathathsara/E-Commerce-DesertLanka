<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shop | Dessert</title>

    <link rel="icon" href="resourses/logo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- nav -->
            <?php require "headder.php"; ?>
            <!-- nav -->
            <!-- hradder -->
            <div class="col-12 d-none d-lg-block shadow my-5" style="background-color: #ffffcc; background-image: linear-gradient(90deg,#ffffcc 0%,#ffff80 100% );" data-aos="flip-up" data-aos-duration="1000">
                <div class="row">
                    <div class="col-6 shopHeadderImg" data-aos="zoom-in" data-aos-duration="1000"></div>
                    <div class="col-6 text-center" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="row">
                            <h1 class="navTitle fw-bold" style="font-size: 64px;">Desert</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- hradder -->
            <hr class="hr-break-1" data-aos="zoom-in" data-aos-duration="1000" />
            <div class="offset-1 offset-lg-2 col-10 col-lg-8 justify-content-center" data-aos="zoom-in" data-aos-duration="1000">
                <div class="row mb-3">
                    <div class="col-10">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control shadow" placeholder="Search Items..." aria-label="Text input with button" id="basic_search_txt" />
                            <button class="btn btn-warning search-btn shadow" onclick="basicSearch(0);">Search</button>
                        </div>
                    </div>

                    <div class="col-2 mt-3 mb-3">
                        <a class="text-black text-decoration-none" href="advancedSearch.php"><span class="fs-3 fw-bold">Advance</span></a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-2 p-0 bg-black bg-opacity-10 shadow rounded" style="background-color: #ffffcc; background-image: linear-gradient(90deg,#ffffcc 0%,#ffff80 100% );" data-aos="fade-right" data-aos-duration="1000">
                        <ul class="p-0">
                            <a href="shop.php">
                                <li class="px-3 py-2 my-1 fs-4 rounded shopCategory">All</li>
                            </a>
                            <?php
                            require "connection.php";
                            $categpryrs1 = Database::search("SELECT * FROM `category`");
                            $num = $categpryrs1->num_rows;
                            for ($y = 0; $y < $num; $y++) {
                                $d = $categpryrs1->fetch_assoc();
                            ?>
                                <li class="px-3 py-2 my-1 rounded shopCategory" onclick="selectCategoty(0,<?php echo $d['id']; ?>);" id="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-10" id="basicSearchResult">
                        <?php
                        $categpryrs1 = Database::search("SELECT * FROM `category`");
                        $num = $categpryrs1->num_rows;
                        for ($y = 0; $y < $num; $y++) {
                            $d = $categpryrs1->fetch_assoc();
                        ?>
                            <!-- Category name -->
                            <div class="col-12" data-aos="fade-right" data-aos-duration="1000">
                                <a href="#" class="link-dark link2 fs-4 text-decoration-none"><?php echo $d["name"]; ?></a>&nbsp;&nbsp;
                                <a href="#" class="link-dark link3" onclick="selectCategoty(0,<?php echo $d['id']; ?>);">See All&nbsp; &rarr;</a>
                            </div>
                            <!-- Category name -->
                            <hr class="hr-break-1" data-aos="zoom-in" data-aos-duration="1000" />
                            <!-- Products -->
                            <div class="col-12 mb-3">
                                <div class="row ">
                                    <div class="col-12 col-lg-12">
                                        <div class="row justify-content-center gap-4">
                                            <?php
                                            $productrs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $d["id"] . "' AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");
                                            $pn = $productrs->num_rows;
                                            for ($z = 0; $z < $pn; $z++) {
                                                $pd = $productrs->fetch_assoc();
                                            ?>
                                                <div class="card col-6 col-lg-2 p-0 mt-2 mb-2" style="width: 18rem;" data-aos="zoom-in-up" data-aos-duration="1000">
                                                    <div class="rounded shadow shopProductCard">
                                                        <?php
                                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pd["id"] . "'");
                                                        $image = $imagers->fetch_assoc();
                                                        ?>
                                                        <img src="<?php echo $image["code"]; ?>" class="card-img-top card-img-top img-thumbnail" style="height: 200px" />
                                                        <div class="card-body ms-0 m-0">
                                                            <h5 class="card-title"><?php echo $pd["title"]; ?></h5>
                                                            <span class="card-text text-primary">Rs. <?php echo $pd["price"]; ?> .00</span>
                                                            <br />
                                                            <a href='<?php echo "singleProductView.php?id=" . ($pd["id"]) ?>' class="btn border border-success col-12 fw-bold buyNowBtn">Buy Now</a>
                                                            <a onclick="addToCart(<?php echo $pd['id']; ?>);" class="btn border border-danger col-12 mt-1 addCartBtn">Add to Cart</a>
                                                            <?php
                                                            $watchlist_num = 0;
                                                            if (isset($_SESSION["u"])) {
                                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pd["id"] . "' AND `users_email`='" . $_SESSION["u"]["email"] . "'");
                                                                $watchlist_num = $watchlist_rs->num_rows;
                                                            }
                                                            if ($watchlist_num == 1) {
                                                            ?>
                                                                <a class="btn border border-secondary col-12 mt-1 watchBtn" onclick='addToWatchlist(<?php echo $pd["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $pd["id"]; ?>"></i></a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a class="btn border border-secondary col-12 mt-1 watchBtn" onclick='addToWatchlist(<?php echo $pd["id"]; ?>);'>
                                                                    <i class="bi bi-heart fs-5 text-danger" id="heart<?php echo $pd["id"]; ?>"></i></a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Products -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- footter -->
            <?php require "footer.php"; ?>
            <!-- footter -->
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>