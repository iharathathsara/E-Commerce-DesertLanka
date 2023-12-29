<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $pageno;
    $email = $_SESSION["a"]["email"];

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>Desert | Update Product</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resourses/logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body style="background-color: #ffffcc; background-image: linear-gradient(90deg,#ffffcc 0%,#ffff80 100% );">

        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="row">

                        <?php

                        $product = $_SESSION["p"];

                        if (isset($product)) {

                        ?>

                            <div class="col-12 text-center">
                                <h2 class="h2 text-primary fw-bold">Update Product</h2>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">

                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold lbl1">Product Category</label>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <select class="form-select" disabled>

                                                    <?php

                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE 
                                                `id`='" . $product["category_id"] . "' ");
                                                    $category_data = $category_rs->fetch_assoc();


                                                    ?>

                                                    <option><?php echo $category_data["name"]; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold lbl1">Product Model</label>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <select class="form-select" disabled>
                                                    <?php

                                                    $model_rs = Database::search("SELECT * FROM `model` WHERE 
                                                `id` IN (SELECT `model_id` FROM `model_has_category` WHERE 
                                                `id`='" . $product["model_has_category_id"] . "')");

                                                    $model_data = $model_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $model_data["name"] ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="hr-break-1" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold lbl1">
                                                    Update a Title to your Product.
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <input type="text" class="form-control" value="<?php echo $product["title"]; ?>" id="ti" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr class="hr-break-1" />

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label fw-bold lbl1">Cost Per Item</label>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["price"]; ?>" id="cost">
                                                    <span class="input-group-text">.00</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="hr-break-1" />

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Delivery Costs</label>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="row">

                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label>Delivery Cost Within Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="row">

                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label>Delivery Cost Out Of Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="hr-break-1" />

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Product Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control" cols="30" rows="25" id="desc"><?php echo $product["description"] ?></textarea>
                                        </div>

                                    </div>
                                </div>

                                <hr class="hr-break-1" />

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Add Product Images</label>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6">
                                            <div class="row">

                                                <?php
                                                $product_image = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                                $n = $product_image->num_rows;


                                                for ($i = 0; $i < $n; $i++) {

                                                    $pid = $product_image->fetch_assoc();

                                                ?>

                                                    <div class="col-4 border border-primary rounded">
                                                        <img class="img-fluid" src="<?php echo $pid["code"]; ?>" id="preview<?php echo $i ?>" />
                                                    </div>

                                                <?php

                                                }

                                                ?>

                                            </div>
                                        </div>

                                        <div class="col-12 offset-lg-3 col-lg-6 d-grid mt-3">
                                            <input type="file" accept="img/*" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Image</label>
                                        </div>

                                    </div>
                                </div>

                                <hr class="hr-break-1" />

                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-2">
                                    <button class="btn btn-success fw-bold" onclick="updateProduct();">Update Product</button>
                                </div>

                            </div>

                    </div>
                </div>

                <?php require "footer.php" ?>

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
                        }
?>
<?php
} else {
    header("location:adminSignin.php");
}

?>