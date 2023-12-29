<!DOCTYPE html>

<html lang="en">

<?php
$order_id = $_GET["id"];
require "connection.php";
?>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | Desert</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" href="resourses/logo.png" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="mt-2" style="background-color: #f7f7ff;">

    <div class="container-fluid">
        <div class="row">

            <?php require "headder.php"; ?>

            <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                <hr />
            </div>

            <div class="col-12 btn btn-toolbar justify-content-end" data-aos="fade-left" data-aos-duration="1000">
                <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                <button class="btn btn-danger me-2"><i class="bi bi-file-pdf-fill"></i> Export as PDF</button>
            </div>

            <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                <hr />
            </div>

            <div class="col-12" id="page">
                <div class="row">

                    <div class="col-6" data-aos="fade-up-right" data-aos-duration="1000">
                        <div class="ms-5 invoiceHeaderImage"></div>
                    </div>

                    <div class="col-6" data-aos="fade-up-left" data-aos-duration="1000">
                        <div class="row">

                            <div class="col-12 text-primary text-decoration-underline text-end">
                                <h2>Dessert</h2>
                            </div>

                            <div class="col-12 fw-bold text-end">
                                <span>Ragama, Sri Lanka.</span><br />
                                <span>+94 763947527</span><br />
                                <span>dessert@gmail.com</span>
                            </div>

                        </div>
                    </div>

                    <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                        <hr class="border border-1 border-primary" />
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row">

                            <div class="col-6" data-aos="fade-up-right" data-aos-duration="1000">
                                <h5>00<?php echo $order_id; ?></h5>
                                <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                <?php
                                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` WHERE `user_has_address`.`users_email` = '" . $_SESSION["u"]["email"] . "'");
                                $address_data = $address_rs->fetch_assoc();
                                $city_id = $address_data["city_id"];

                                $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
                                $district_data = $district_rs->fetch_assoc();
                                $district_id = $district_data["district_id"];
                                ?>
                                <span><?php echo $address_data["line1"] . ", " . $address_data["line2"] . ", " . $address_data["name"] . "." ?></span><br />
                                <span class="fw-bold"><?php echo $_SESSION["u"]["email"]; ?></span>
                            </div>

                            <div class="col-6 text-end mt-4" data-aos="fade-up-left" data-aos-duration="1000">
                                <h1 class="text-primary">INVOICE 01</h1>
                                <span class="fw-bold">Date & Time of Invoice :</span>&nbsp;
                                <?php
                                $order_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $order_id . "'");
                                $order_num = $order_rs->num_rows;

                                $d = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $d->setTimezone($tz);
                                $date = $d->format("Y-m-d H:i:s");

                                ?>
                                <span class="fw-bold"><?php echo $date; ?></span>
                            </div>

                        </div>
                    </div>



                    <div class="col-12">
                        <table class="table">

                            <thead>
                                <tr class="border border-1 border-white" data-aos="zoom-in-down" data-aos-duration="1000">
                                    <th>#</th>
                                    <th>Order ID & Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Shipping</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $shipping = 0;
                                $total = 0;

                                for ($x = 0; $x < $order_num; $x++) {
                                    $order_data = $order_rs->fetch_assoc();

                                ?>

                                    <tr style="height: 72px;" data-aos="zoom-in-up" data-aos-duration="1000">
                                        <td class="border fs-3"><?php echo $order_data["id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-primary text-decoration-underline p-2"><?php echo $order_data["order_id"]; ?></span>
                                            <br />
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $order_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $total + ($product_data["price"] * $order_data["qty"]);
                                            $ship = 0;

                                            if ($district_id == 9) {
                                                $ship = $product_data["delivery_fee_colombo"];
                                            } else {
                                                $ship = $product_data["delivery_fee_other"];
                                            }
                                            $shipping = $shipping + $ship;

                                            ?>
                                            <span class="fw-bold fs-3 text-primary p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-3 border">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="fw-bold fs-6 text-end pt-3 border">Rs. <?php echo $ship; ?> .00</td>
                                        <td class="fw-bold fs-6 text-end pt-3"><?php echo $order_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end border">Rs. <?php echo $order_data["total"]; ?> .00</td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>

                            <tfoot>

                                <tr data-aos="zoom-in-up" data-aos-duration="1000">
                                    <td colspan="4" class="border-0"></td>
                                    <td class="fs-5 text-end">SUBTOTAL</td>
                                    <td class="text-end">Rs. <?php echo $total; ?> .00</td>
                                </tr>

                                <tr data-aos="zoom-in-up" data-aos-duration="1000">
                                    <td colspan="4" class="border-0"></td>
                                    <td class="fs-5 text-end">SHIPPING</td>
                                    <td class="text-end">Rs. <?php echo $shipping; ?> .00</td>
                                </tr>

                                <tr data-aos="zoom-in-up" data-aos-duration="1000">
                                    <td colspan="4" class="border-0"></td>

                                    <td class="fs-5 text-end border-primary">DISCOUNT</td>
                                    <td class="text-end border-primary">Rs. <?php
                                                                            $subTotal = $total + $shipping;
                                                                            $discount = 0;
                                                                            if ($subTotal > "250000") {
                                                                                $discount = ($subTotal / 100) * 1;
                                                                                echo $discount;
                                                                            } else if ($subTotal > "500000") {
                                                                                $discount = ($subTotal / 100) * 2;
                                                                                echo $discount;
                                                                            } else if ($subTotal > "1000000") {
                                                                                $discount = ($subTotal / 100) * 3;
                                                                                echo $discount;
                                                                            }
                                                                            ?>.00</td>
                                </tr>

                                <tr data-aos="zoom-in-up" data-aos-duration="1000">
                                    <td colspan="4" class="border-0"></td>
                                    <td class="fs-5 text-end border-primary text-primary fw-bold">GRAND TOTAL</td>
                                    <td class="fs-5 text-end border-primary text-primary fw-bold">Rs. <?php echo $subTotal - $discount; ?> .00</td>
                                </tr>

                            </tfoot>

                        </table>
                    </div>

                    <div class="col-4 text-center" style="margin-top: -100px;" data-aos="zoom-in-up" data-aos-duration="1000">
                        <span class="fs-1 fw-bold text-success">Thank You!</span>
                    </div>

                    <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-primary rounded" style="background-color: #e7f2ff;" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label fw-bold fs-5">NOTICE :</label>
                                <label class="form-label fs-6">Purchased items can return before 24 hours of Delivery.</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                        <hr class="border border-1 border-primary" />
                    </div>

                    <div class="col-12 text-center mb-3" data-aos="zoom-in-up" data-aos-duration="1000">
                        <label class="form-label fs-5 text-black-50 fw-bold">
                            Invoice was created on a computer is valid without a Signature and Seal.
                        </label>
                    </div>

                </div>
            </div>

            <?php require "footer.php"; ?>

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