<?php

require "connection.php";

if (isset($_GET["id"])) {

    $invoice_id = $_GET["id"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id` LIKE '%" . $invoice_id . "%'");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 1) {

        $invoice_data = $invoice_rs->fetch_assoc();

?>
        <!--  -->
        <div class="row">

            <div class="col-1 border text-center">
                <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
            </div>

            <div class="col-3 border">

                <?php
                $pid = $invoice_data["product_id"];

                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                $product_data = $product_rs->fetch_assoc();

                ?>

                <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
            </div>

            <div class="col-3 border">

                <?php
                $uemail = $invoice_data["user_email"];

                $buyer_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $uemail . "'");
                $buyer_data = $buyer_rs->fetch_assoc();
                ?>

                <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></label>
            </div>

            <div class="col-2 border text-end">
                <label class="form-label fs-6 fw-bold mt-1 mb-1">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
            </div>

            <div class="col-1 border text-center">
                <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></label>
            </div>

            <div class="col-2 border d-grid">

                <?php

                if ($invoice_data["status"] == 0) {
                ?>
                    <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data['id']; ?>">Confirm Order</button>
                <?php
                } else if ($invoice_data["status"] == 1) {
                ?>
                    <button class="btn btn-warning fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data['id']; ?>">Packing</button>
                <?php
                } else  if ($invoice_data["status"] == 2) {
                ?>
                    <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data['id']; ?>">Dispatch</button>
                <?php
                } else  if ($invoice_data["status"] == 3) {
                ?>
                    <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data['id']; ?>">Shipping</button>
                <?php
                } else  if ($invoice_data["status"] == 4) {
                ?>
                    <button class="btn btn-danger fw-bold mt-1 mb-1 disabled" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data['id']; ?>">Delivered</button>
                <?php
                }
                ?>

            </div>
        </div>
        <!--  -->

<?php

    } else {
    }
}

?>