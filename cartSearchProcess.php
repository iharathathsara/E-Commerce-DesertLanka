<?php
session_start();
require "connection.php";
$txt = $_POST["txt"];

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $uemail . "'");
    $address_rs_num = $address_rs->num_rows;

    $total = 0;
    $subTotal = 0;
    $shipping = 0;

?>

    <div class="row">

        <?php

        $cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON `cart`.`product_id`=`product`.`id` WHERE `cart`.`user_email`='" . $uemail . "' AND `product`.`title` LIKE '%" . $txt . "%'");
        $cart_num = $cart_rs->num_rows;

        $address_data = $address_rs->fetch_assoc();
        $city_id = $address_data["city_id"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();
        $district_id = $district_data["district_id"];

        if ($cart_num == 0) {

        ?>

            <!-- empty -->
            <div class="col-12 col-lg-9 d-flex align-items-center justify-content-center">
                <div class="row">

                    <div class="col-12 emptycart"></div>

                    <div class="col-12 text-center mb-2">
                        <label class="form-label fs-1">You have no item in your Basket.</label>
                    </div>

                    <div class="offset-2 offset-lg-4 col-8 col-lg-4 d-grid mb-4">
                        <a href="shop.php" class="btn btn-primary fs-5">Start Shopping</a>
                    </div>

                </div>
            </div>
            <!-- empty -->

        <?php

        } else {

        ?>
            <div class="col-md-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
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
                <div class="col-12 col-lg-9">
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
                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cart_data["qty"]; ?>" id="cardCartQty" onclick="cartCartQty(<?php echo $product_data['id']; ?>);" />

                                        <br /><br />

                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $ship; ?>.00</span>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card-body d-grid">
                                        <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
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
                <!-- </div> -->

                <!-- have products -->

        <?php

            }
        }

        ?>

        <div class="col-12 col-lg-3">
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
<?php

}
?>