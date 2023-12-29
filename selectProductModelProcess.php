<?php
session_start();
require "connection.php";
if (isset($_SESSION["a"])) {
    $cid = $_GET["id"];

    $model_rs = Database::search("SELECT `model`.`id`, `model`.`name` FROM `model_has_category` INNER JOIN `model` ON `model_has_category`.`model_id`=`model`.`id` WHERE `model_has_category`.`category_id`='" . $cid . "'");
    $model_num = $model_rs->num_rows;

?>
    <div class="row">
        <div class="col-12">
            <label class="form-label fw-bold lbl1">Select Product Model</label>
        </div>
        <div class="col-12 mb-3">
            <select class="form-select" id="model">
                <option value="0">Select Model</option>

                <?php

                for ($z = 0; $z < $model_num; $z++) {

                    $model_data = $model_rs->fetch_assoc();

                ?>

                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>

                <?php

                }

                ?>

            </select>
        </div>
    </div>
<?php
}
?>