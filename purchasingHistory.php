<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Purchasing History | Dessert</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" href="resourses/logo.png" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "headder.php";
            require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "'");
                $invoice_num = $invoice_rs->num_rows;

            ?>

                <div class="col-12 pt-2" data-aos="fade-right" data-aos-duration="1000">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="shop.php" class="text-decoration-none">Shop</a></li>
                            <li class="breadcrumb-item active" arial-current="page">Purchasing History</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12" data-aos="fade-right" data-aos-duration="1000">
                    <label class="form-label fs-1 fw-bold">Purchasing History <i class="bi bi-handbag-fill fs-2"></i></label>
                </div>

                <?php

                if ($invoice_num == 0) {
                ?>

                    <div class="col-12 bg-body text-center" data-aos="fade-up" data-aos-duration="1000" style="height: 450px;">
                        <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">
                            You have not purchased any product yet...
                        </span>
                    </div>

                <?php
                } else {
                ?>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block" data-aos="zoom-in" data-aos-duration="1000">
                                <div class="row">
                                    <div class="col-1 bg-light">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-4 bg-light text-center">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light text-center">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-light text-center">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light text-center">
                                        <label class="form-label fw-bold">Purchase Date & Time</label>
                                    </div>
                                    <div class="col-2 bg-light"></div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                </div>
                            </div>

                            <?php

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                            ?>
                                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="row">

                                        <div class="col-12 col-lg-1 border text-start">
                                            <label class="form-label text-black-50 fs-6 py-5"><?php echo $invoice_data['order_id'] ?></label>
                                        </div>

                                        <?php

                                        $pid = $invoice_data["product_id"];

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $pid . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $u_email = $product_data["users_email"];

                                        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $u_email . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                        ?>

                                        <div class="col-12 col-lg-4 border">
                                            <!-- <div class="card mx-0 mx-lg-3 my-3" style="max-width: 540px;"> -->
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $product_data["title"] ?></h5>
                                                        <p class="card-text"><b>Seller : </b> <?php echo $user_data["fname"] ?></p>
                                                        <p class="card-text"><b>Price : </b> Rs. <?php echo $product_data["price"] ?> .00</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>

                                        <div class="col-6 col-lg-1 text-center text-lg-end border">
                                            <label class="d-lg-none form-label fs-4 text-black-50 fw-bold py-5">Quantity : </label>
                                            <label class="form-label fs-4 py-lg-5"><?php echo $invoice_data["qty"] ?></label>
                                        </div>

                                        <div class="col-6 col-lg-2 border text-center text-lg-end">
                                            <label class="form-label text-black fs-5 py-5">Rs.<?php echo $invoice_data["total"] ?>.00</label>
                                        </div>

                                        <div class="col-12 col-lg-2 border text-center text-lg-end">
                                            <label class="form-label fs-5 py-5"><?php echo $invoice_data["date"] ?></label>
                                        </div>

                                        <div class="col-12 col-lg-2 border">
                                            <div class="row">
                                                <div class="col-12 d-grid">
                                                    <?php
                                                    $status = $invoice_data["status"];
                                                    if ($status == 0) {
                                                    ?>
                                                        <div class="bg-danger border fs-5 text-center text-white py-2 rounded mt-4 border-danger">
                                                            Pending
                                                        </div>
                                                    <?php
                                                    } else if ($status == 1) {
                                                    ?>
                                                        <div class="bg-warning border text-center py-2 fs-5 rounded mt-4 border-warning">
                                                            Packing
                                                        </div>
                                                    <?php
                                                    } else if ($status == 2) {
                                                    ?>
                                                        <div class="bg-info border text-center py-2 fs-5 rounded mt-4 border-info">
                                                            Dispatch
                                                        </div>
                                                    <?php
                                                    } else if ($status == 3) {
                                                    ?>
                                                        <div class="bg-primary border text-center py-2 text-white fs-5 rounded mt-4 border-primary">
                                                            Shipping
                                                        </div>
                                                    <?php
                                                    } else if ($status == 4) {
                                                    ?>
                                                        <div class="bg-success border text-center py-2 text-white fs-5 rounded mt-4 border-success">
                                                            Delivered
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-12 d-grid">
                                                    <button class="btn btn-secondary border border-1 fs-5 rounded mt-1 border-primary" onclick="addFeedback(<?php echo $invoice_data['id'] ?>);">
                                                        <i class="bi bi-info-circle-fill"></i> Feedback
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-lg-none mt-2 mb-3">
                                            <hr class="border border-3 border-dark" />
                                        </div>

                                    </div>
                                </div>

                                <!-- model -->
                                <div class="modal" tabindex="-1" id="feedbackModal<?php echo $invoice_data['id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add New Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label class="form-label fw-bold">Type</label>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type1<?php echo $invoice_data['id'] ?>">
                                                                        <label class="form-check-label text-success fw-bold" for="type1<?php echo $invoice_data['id'] ?>">
                                                                            Positive
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type2<?php echo $invoice_data['id'] ?>" checked>
                                                                        <label class="form-check-label text-warning fw-bold" for="type2<?php echo $invoice_data['id'] ?>">
                                                                            Neutral
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type3<?php echo $invoice_data['id'] ?>">
                                                                        <label class="form-check-label text-danger fw-bold" for="type3<?php echo $invoice_data['id'] ?>">
                                                                            Negative
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label class="form-label fw-bold">User's email</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" value="<?php echo $umail; ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label class="form-label fw-bold">Feedback</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <textarea cols="50" rows="8" class="form-control" id="feed<?php echo $invoice_data['id'] ?>"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="saveFeedback(<?php echo $invoice_data['id'] ?>);">Send Feedback</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- model -->


                            <?php
                            }

                            ?>

                            <input type="text" class="form-control" id="f" />

                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

        </div>
    </div>

<?php
                }
?>


<?php
            }
?>

<?php include "footer.php"; ?>
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