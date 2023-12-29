<?php
session_start();
if (isset($_SESSION["u"])) {

    $pid = $_GET["id"];
    require "connection.php";

    $email = $_SESSION["u"]["email"];

    $resultset = Database::search("SELECT * FROM `users` INNER JOIN `user_has_address` ON `users`.`email`=`user_has_address`.`users_email` WHERE `users`.`email`='" . $email . "'");
    $n = $resultset->num_rows;

    $district_rs = database::search("SELECT * FROM `district` WHERE `province_id` = '" . $pid . "'");
    $district_num = $district_rs->num_rows;

?>

    <label class="form-label">District</label>
    <select class="form-select" id="dr">

        <option value="0">Select District</option>

        <?php
        $dn = $districtrs->num_rows;
        for ($y = 0; $y < $district_num; $y++) {
            $dd = $district_rs->fetch_assoc();
        ?>
            <option value="<?php echo $dd["id"]; ?>"><?php echo $dd["name"]; ?></option>

        <?php
        }
        ?>

    </select>

<?php
}
?>