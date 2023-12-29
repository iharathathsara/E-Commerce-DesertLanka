<!DOCTYPE html>
<html>

<head>
    <title>Cart | Dessert</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resourses/logo.png" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            require "headder.php";
            require "connection.php";
            if (isset($_SESSION["u"])) {
                $uemail = $_SESSION["u"]["email"];
                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $uemail . "'");
                $address_rs_num = $address_rs->num_rows;
                if ($address_rs_num != 0) {
                    $total = 0;
                    $subTotal = 0;
                    $shipping = 0;
            ?>
                    <div class="col-12 pt-2" data-aos="fade-up-right" data-aos-duration="1000">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="shop.php" class="text-decoration-none">Shop</a></li>
                                <li class="breadcrumb-item active" arial-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                        <hr class="hr-break-1" />
                    </div>

                    <div class="col-12 border border-0 border-secondary rounded mb-3">
                        <div class="row">
                            <div class="col-12" data-aos="fade-up-right" data-aos-duration="1000">
                                <label class="form-label fs-1 fw-bold">Cart <i class="bi bi-cart3 fs-2"></i></label>
                            </div>
                            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                <div class="row">
                                    <div class="col-8 col-lg-6 offset-0 offset-lg-2 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in Basket.." id="cartSearch" />
                                    </div>
                                    <div class="col-4 col-lg-3 mb-3">
                                        <button class="btn btn-outline-warning fw-bold col-12 col-lg-6" onclick="cartSearch();">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                <hr class="hr-break-1" />
                            </div>
                            <div class="col-12" id="cartProducts">
                                <div class="row">
                                    <?php
                                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                                    $cart_num = $cart_rs->num_rows;

                                    $address_data = $address_rs->fetch_assoc();
                                    $city_id = $address_data["city_id"];

                                    $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
                                    $district_data = $district_rs->fetch_assoc();
                                    $district_id = $district_data["district_id"];
                                    if ($cart_num == 0) {
                                    ?>
                                        <!-- empty -->
                                        <div class="col-12 col-lg-9 d-flex align-items-center justify-content-center" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="row">
                                                <div class="col-12 emptycart"></div>
                                                <div class="col-12 text-center mb-2">
                                                    <label class="form-label fs-1">You have no item in your Basket.</label>
                                                </div>
                                                <div class="offset-2 offset-lg-4 col-8 col-lg-4 d-grid mb-4">
                                                    <a href="shop.php" class="btn btn-warning fs-5">Start Shopping</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- empty -->
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-12 mt-3 mb-3" data-aos="fade-down" data-aos-duration="1000">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="fw-bold text-black-50 fs-5">Buyer :</span>&nbsp;
                                                    <span class="fw-bold text-black fs-5">
                                                        <?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?>
                                                    </span>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            $total = $total + ($product_data["price"] * $cart_data["qty"]);
                                            $ship = 0;
                                            if ($district_id == 9) {
                                                $ship = $product_data["delivery_fee_colombo"];
                                                $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                            } else {
                                                $ship = $product_data["delivery_fee_other"];
                                                $shipping = $shipping + $product_data["delivery_fee_other"];
                                            }
                                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                            $user_data = $user_rs->fetch_assoc();
                                        ?>
                                            <!-- have products -->
                                            <div class="col-12 col-lg-9" data-aos="fade-up-right" data-aos-duration="1000">
                                                <div class="row">
                                                    <div class="card mb-3 mx-0 col-12">
                                                        <div class="row g-0">
                                                            <hr />
                                                            <div class="col-md-4">
                                                                <?php
                                                                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                                $img_data = $img_rs->fetch_assoc();
                                                                ?>
                                                                <span class="d-inline-block" data-bs-trigger="hover focus" tabindex="0" data-bs-toggle="popover" title="Product Description" data-bs-content="<?php echo $product_data["description"]; ?>">
                                                                    <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;" />
                                                                </span>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                                    <span class="fw-bold text-black fs-5">Rs. <?php echo  $product_data["price"]; ?>.00</span>
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                                    <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cart_data["qty"]; ?>" id="cardCartQty<?php echo $product_data['id']; ?>" onclick="cartCartQty(<?php echo $product_data['id']; ?>);" />
                                                                    <br /><br />
                                                                    <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                                    <span class="fw-bold text-black fs-5">Rs. <?php echo $ship; ?>.00</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="card-body d-grid">
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]) ?>' class="btn btn-outline-success mb-2">Buy Now</a>
                                                                    <a href="#" class="btn btn-outline-danger" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            <div class="col-md-12 mt-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                                    </div>
                                                                    <div class="col-6 text-end">
                                                                        <span class="fw-bold fs-5 text-black-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- have products -->
                                    <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-12 col-lg-3" data-aos="fade-up-left" data-aos-duration="1000">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-3 fw-bold">Summary</label>
                                            </div>

                                            <div class="col-12">
                                                <hr />
                                            </div>

                                            <div class="col-6 mb-3">
                                                <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                            </div>

                                            <div class="col-6 text-end mb-3">
                                                <span class="fs-6 fw-bold">Rs. <?php echo $total; ?>.00 </span>
                                            </div>

                                            <div class="col-6">
                                                <span class="fs-6 fw-bold">Shipping</span>
                                            </div>

                                            <div class="col-6 text-end">
                                                <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?>.00</span>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <hr />
                                            </div>

                                            <div class="col-6 mt-2">
                                                <span class="fs-4 fw-bold">Total</span>
                                            </div>

                                            <div class="col-6 mt-2 text-end">
                                                <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?>.00</span>
                                            </div>

                                            <div class="col-12 mt-3 mb-3 d-grid">
                                                <button class="btn btn-warning fs-5 fw-bold" onclick="cartCheckOut();">CHECKOUT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php require "footer.php"; ?>

                            </div>

                            <div class="col-12">
                                <hr class="hr-break-1" />
                            </div>

                        </div>
                    </div>


        </div>
    </div>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
<?php
                } else {
?>
    <script>
        alert("Please Update Your Profile");
        window.location = "userprofile.php";
    </script>
<?php
                }
            } else {
?>
<script>
    alert("Please Sign In First");
    window.location = "index.php";
</script>
<?php
            }
?>
</body>

</html>