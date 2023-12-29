<?php

require "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {

    $from = $_GET["f"];
    $to = $_GET["t"];

    $invoice_rs = Database::search("SELECT * FROM `invoice`");
    $invoice_num = $invoice_rs->num_rows;

    for ($x = 0; $x < $invoice_num; $x++) {
        $invoice_data = $invoice_rs->fetch_assoc();
        $sold_date = $invoice_data["date"];
        $date = explode(" ", $sold_date);

        $d = $date[0];
        $t = $date[1];

        if (!empty($from) && empty($to)) {

            if ($from <= $d) {
?>
                <div class="row">

                    <div class="col-1 border text-center">
                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
                    </div>

                    <?php
                    $pid = $invoice_data["product_id"];

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                    $product_data = $product_rs->fetch_assoc();

                    ?>
                    <div class="col-3 border">
                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                    </div>

                    <?php
                    $uemail = $invoice_data["user_email"];

                    $buyer_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $uemail . "'");
                    $buyer_data = $buyer_rs->fetch_assoc();
                    ?>

                    <div class="col-3 border">
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
            <?php
            }
        } else if (empty($from) && !empty($to)) {

            if ($to >= $d) {
            ?>
                <div class="row">

                    <div class="col-1 border text-center">
                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
                    </div>

                    <?php
                    $pid = $invoice_data["product_id"];

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                    $product_data = $product_rs->fetch_assoc();

                    ?>

                    <div class="col-3 border">
                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                    </div>

                    <?php
                    $uemail = $invoice_data["user_email"];

                    $buyer_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $uemail . "'");
                    $buyer_data = $buyer_rs->fetch_assoc();
                    ?>

                    <div class="col-3 border">

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
            <?php
            }
        } else if (!empty($from) && !empty($to)) {

            if ($from <= $d && $to >= $d) {
            ?>
                <div class="row">

                    <div class="col-1 border text-center">
                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
                    </div>

                    <?php
                    $pid = $invoice_data["product_id"];

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                    $product_data = $product_rs->fetch_assoc();

                    ?>

                    <div class="col-3 border">
                        <label class="form-label fs-6 fw-bold mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                    </div>

                    <?php
                    $uemail = $invoice_data["user_email"];

                    $buyer_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $uemail . "'");
                    $buyer_data = $buyer_rs->fetch_assoc();
                    ?>
                    
                    <div class="col-3 border">
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
<?php
            }
        }
    }
}

?>