<?php

require "connection.php";

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Watchlist | Dessert</title>
    <link rel="icon" href="resourses/logo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            require "headder.php";

            if (isset($_SESSION["u"])) {

                $u = $_SESSION["u"]["email"];

                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $u . "'");
                $user_data = $user_rs->fetch_assoc();

            ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12" data-aos="fade-right" data-aos-duration="1000">
                                    <label class="form-label fs-1 fw-bolder">Watchlist &hearts;</label>
                                </div>

                                <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="row">

                                        <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in Watchlist..." id="searchtxt" />
                                        </div>
                                        <div class="col-12 col-lg-2 mb-3 d-grid">
                                            <button class="btn btn-outline-warning" onclick="watchlistSearch();">Search</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                    <hr class="hr-break-1" />
                                </div>

                                <div class="col-11 col-lg-2 border-0 border-end border-1 border-warning" data-aos="fade-up-right" data-aos-duration="1000">

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>

                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active bg-warning text-black" aria-current="page" href="watchlist.php">My Watchlist</a>
                                        <a class="nav-link" href="cart.php">My Cart</a>
                                        <a class="nav-link" href="recent.php">Recents</a>
                                    </nav>

                                </div>

                                <div class="col-12 col-lg-9" id="watchlistSearchProducts">

                                    <?php

                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `users_email`='" . $u . "'");
                                    $watchlist_num = $watchlist_rs->num_rows;

                                    if ($watchlist_num == 0) {

                                    ?>
                                        <!-- no items -->
                                        <div class="row" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">
                                                    You have no items in your Watchlist yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="shop.php" class="btn btn-warning fs-3 fw-bold">
                                                    Strat Shopping
                                                </a>
                                            </div>
                                        </div>
                                        <!-- no items -->
                                    <?php

                                    } else {

                                    ?>
                                        <!-- have products -->
                                        <div class="row g-2">
                                            <?php

                                            for ($x = 0; $x < $watchlist_num; $x++) {

                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $product_id = $watchlist_data["product_id"];

                                                // search product
                                                $product_rs = Database::search("SELECT `images`.`code`,`product`.`title`,`product`.`price`,`description` FROM `product`
                                                INNER JOIN `images` ON `images`.`product_id`=`product`.`id` 
                                                WHERE `product`.`id`='" . $product_id . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                            ?>

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12" data-aos="fade-up" data-aos-duration="1000">
                                                    <div class="row g-0">

                                                        <div class="col-md-4 d-flex align-items-center">
                                                            <img src="<?php echo $product_data["code"] ?>" class="img-fluid rounded-start" />
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold fs-2 text-success"><?php echo $product_data["title"]; ?></h5>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Price : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Description : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 text-black-50">Rs. <?php echo $product_data["description"]; ?> .00</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a href='<?php echo "singleProductView.php?id=" . ($product_id) ?>' class="btn btn-outline-success mb-2">Buy Now</a>
                                                                <a class="btn btn-outline-secondary mb-2" onclick="addToCart(<?php echo $product_id ?>);">Add to Cart</a>
                                                                <a class="btn btn-outline-danger" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);">Remove</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            <?php

                                            }
                                            ?>
                                        </div>
                                        <!-- have products -->
                                    <?php
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php require "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
<?php

            } else {
?>
    <script>
        alert("Please Sing in or Register first");
        window.location = "index.php";
    </script>
<?php
            }

?>
</body>

</html>