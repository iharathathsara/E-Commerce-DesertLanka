<!DOCTYPE html>
<html>

<head>
    <title>User Profile | Dessert</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resourses/logo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <?php require "headder.php";
            require "connection.php";
            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];
                $resultset = Database::search("SELECT * FROM `users` INNER JOIN `profile_image` ON `profile_image`.`users_email`=`users`.`email`INNER JOIN `user_has_address` ON `users`.`email`=`user_has_address`.`users_email` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`id` INNER JOIN `district` ON `city`.`district_id`=`district`.`id` INNER JOIN `province` ON `district`.`province_id`=`province`.`id` INNER JOIN `gender` ON `gender`.`id`=`users`.`gender_id` WHERE `users`.`email`='" . $email . "'");
                $n = $resultset->num_rows;
                if ($n == 0) {
                    $resultset = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON `gender`.`id`=`users`.`gender_id` WHERE `users`.`email`='" . $email . "'");
                }
                $d = $resultset->fetch_assoc();
            ?>

                <div class="col-12 pt-2" data-aos="fade-up" data-aos-duration="1000">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white bg-opacity-10">
                            <li class="breadcrumb-item"><a href="shop.php" class="text-decoration-none">Shop</a></li>
                            <li class="breadcrumb-item active" arial-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                    <hr class="hr-break-1" />
                </div>

                <div class="col-12" data-aos="fade-right" data-aos-duration="1000">
                    <label class="form-label fs-1 fw-bold">Profile <i class="bi bi-person-fill fs-2"></i></label>
                </div>

                <div class="col-12 bg-body rounded mt-4 mb-4">
                    <div class="row g-2">
                        <div class="col-md-3 border-end shadow" data-aos="fade-up-right" data-aos-duration="1000" style="background-color: #ffffcc; background-image: linear-gradient(-90deg,#ffffcc 0%,#ffff80 100% );">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <?php
                                if (!isset($d["path"])) {
                                ?>
                                    <img id="viewimg" src="resourses//profile_img//newuser.svg" class="rounded mt-5" style="width: 150px;" />
                                <?php
                                } else {
                                ?>
                                    <img id="viewimg" src="<?php echo $d["path"]; ?>" class="rounded mt-5" style="width: 150px;" />
                                <?php
                                }
                                ?>
                                <span class="fw-bold"><?php echo $d["fname"]; ?> <?php echo $d["lname"]; ?></span>
                                <span class="text-black-50"><?php echo $d["email"]; ?></span>

                                <input class="d-none" type="file" accept="img/*" id="profileimg" />
                                <label class="btn btn-warning mt-5" for="profileimg" onclick="changeImage();">Update Profile Image</label>

                            </div>
                        </div>

                        <div class="offset-md-1 col-md-7 border-end">
                            <div class="p-3 py-5 ">

                                <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-up-right" data-aos-duration="1000">
                                    <h4 class="fw-bold">Profile Settings</h4>
                                </div>

                                <div class="row mt-3">

                                    <div class="col-md-6" data-aos="fade-up-right" data-aos-duration="1000">
                                        <label class="form-label">First Name</label>
                                        <input type="text" id="fn" class="form-control" value="<?php echo $d["fname"]; ?>" />
                                    </div>

                                    <div class="col-md-6" data-aos="fade-up-left" data-aos-duration="1000">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" id="ln" class="form-control" value="<?php echo $d["lname"]; ?>" />
                                    </div>

                                    <div class="col-md-12" data-aos="fade-up-right" data-aos-duration="1000">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" id="mo" class="form-control" value="<?php echo $d["mobile"]; ?>" />
                                    </div>

                                    <div class="col-md-12" data-aos="fade-up-left" data-aos-duration="1000">
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" aria-describedby="viewpassword" id="pwtxt" value="<?php echo $d["password"]; ?>" disabled />
                                            <button class="btn btn-outline-warning" id="viewpassword" onclick="viewpw();"><i class="bi bi-eye-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-md-12" data-aos="fade-up-right" data-aos-duration="1000">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo $d["email"]; ?>" readonly />
                                    </div>

                                    <div class="col-md-12 mt-1" data-aos="fade-up-left" data-aos-duration="1000">
                                        <label class="form-label">Registered Date</label>
                                        <input type="text" class="form-control" value="<?php echo $d["joined_date"]; ?>" readonly />
                                    </div>

                                    <?php

                                    if (!empty($d["line1"])) {

                                    ?>
                                        <div class="col-md-12 mt-1" data-aos="fade-up-right" data-aos-duration="1000">
                                            <label class="form-label">Address Line 01</label>
                                            <input id="l1" type="text" class="form-control" value="<?php echo $d["line1"]; ?>" />
                                        </div>
                                    <?php

                                    } else {

                                    ?>
                                        <div class="col-md-12 mt-1" data-aos="fade-up-right" data-aos-duration="1000">
                                            <label class="form-label">Address Line 01</label>
                                            <input id="l1" type="text" class="form-control" placeholder="Address Line 01" />
                                        </div>
                                    <?php

                                    }

                                    if (!empty($d["line2"])) {

                                    ?>
                                        <div class="col-md-12 mt-1" data-aos="fade-up-left" data-aos-duration="1000">
                                            <label class="form-label">Address Line 02</label>
                                            <input id="l2" type="text" class="form-control" value="<?php echo $d["line2"]; ?>" />
                                        </div>
                                    <?php

                                    } else {

                                    ?>
                                        <div class="col-md-12 mt-1" data-aos="fade-up-left" data-aos-duration="1000">
                                            <label class="form-label">Address Line 02</label>
                                            <input id="l2" type="text" class="form-control" placeholder="Address Line 02" />
                                        </div>
                                    <?php

                                    }

                                    $provincers = Database::search("SELECT * FROM `province`");
                                    $districtrs = Database::search("SELECT * FROM `district`");


                                    $userAdd = Database::search("SELECT `city`.`id` AS `cityId`, `district`.`id` AS `districtId`, `province`.`id` AS `provinceId` FROM `users` INNER JOIN `user_has_address` ON `users`.`email`=`user_has_address`.`users_email` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`id` INNER JOIN `district` ON `city`.`district_id`=`district`.`id` INNER JOIN `province` ON `district`.`province_id`=`province`.`id` WHERE `users`.`email`='" . $email . "'");
                                    $userAddData = $userAdd->fetch_assoc();
                                    ?>

                                    <div class="col-md-6 mt-1" data-aos="fade-up-right" data-aos-duration="1000">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="pr" onchange="selectProvince();">
                                            <option value="0">Select Province</option>

                                            <?php
                                            $pn = $provincers->num_rows;

                                            for ($x = 0; $x < $pn; $x++) {
                                                $pd = $provincers->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $pd["id"]; ?>" <?php if ($n == 1) {
                                                                                                if ($userAddData["provinceId"] == $pd["id"]) {
                                                                                            ?> selected <?php
                                                                                                    }
                                                                                                }
                                                                                                        ?>><?php echo $pd["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-1" id="districtBox" data-aos="fade-up-left" data-aos-duration="1000">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="dr">

                                            <option value="0">Select District</option>

                                            <?php
                                            $dn = $districtrs->num_rows;
                                            for ($y = 0; $y < $dn; $y++) {
                                                $dd = $districtrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $dd["id"]; ?>" <?php if ($n == 1) {
                                                                                                if ($userAddData["districtId"] == $dd["id"]) {
                                                                                            ?> selected <?php
                                                                                                    }
                                                                                                }    ?>><?php echo $dd["name"]; ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>



                                    <div class="col-md-6 mt-1" data-aos="fade-up-right" data-aos-duration="1000">
                                        <label class="form-label">City</label>
                                        <?php
                                        if (!empty($d["city_id"])) {
                                            $cityrs = Database::search("SELECT * FROM `city` where `id` = '" . $d["city_id"] . "'");
                                            $city_data = $cityrs->fetch_assoc();
                                        ?>
                                            <input id="ci" type="text" class="form-control" value="<?php echo $city_data["name"]; ?>" />
                                        <?php
                                        } else {
                                        ?>
                                            <input id="ci" type="text" class="form-control" placeholder="City" />
                                        <?php
                                        }

                                        ?>
                                    </div>

                                    <div class="col-md-6 mt-1" data-aos="fade-up-left" data-aos-duration="1000">
                                        <label class="form-label">Postal Code</label>
                                        <?php

                                        if (!empty($d["postal_code"])) {
                                        ?>
                                            <input id="pc" type="text" class="form-control" value="<?php echo $d["postal_code"]; ?>" />
                                        <?php
                                        } else {
                                        ?>
                                            <input id="pc" type="text" class="form-control" placeholder="Postal Code" />
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-12 mt-1" data-aos="fade-up-right" data-aos-duration="1000">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" value="<?php echo $d["gender_name"]; ?>" readonly />
                                    </div>

                                    <div class="col-md-12 d-grid my-3" data-aos="fade-up" data-aos-duration="1000">
                                        <span class="text-danger" id="profileUpdateError"></span>
                                        <button class="btn btn-warning shadow" onclick="update_profile();">Update My Profile</button>
                                    </div>
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
</body>

</html>

<?php

            } else {

?>
    <script>
        window.location = "index.php";
    </script>
<?php

            }

?>