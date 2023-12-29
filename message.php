<?php

session_start();
if (isset($_SESSION["a"])) {

    require "connection.php";
    $mail = $_SESSION["a"]["email"];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Messages | Admin | Dessert</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link rel="icon" href="resourses/logo.png" />
    </head>

    <body style="background-color: #f8f9fa; background-image: linear-gradient(-90deg,#f8f9fa 0%,#ffc107 100% );">

        <div class="container-fluid">
            <div class="row">

                <!-- nav -->

                <div class="d-none d-lg-block col-lg-2 position-fixed" data-aos="fade-up-right" data-aos-duration="1000">
                    <div class="row">

                        <div class="align-items-start bg-dark col-12" style="height: 100vh;">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5" data-aos="zoom-in" data-aos-duration="1000">
                                    <?php

                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $mail . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;

                                    if ($profile_img_num == 1) {

                                        $profile_img_data = $profile_img_rs->fetch_assoc();

                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" class="rounded-circle" width="90px" height="90px" />
                                    <?php

                                    } else {

                                    ?>
                                        <img src="resourses/profile_img/newuser.svg" class="rounded-circle" width="90px" height="90px" />
                                    <?php

                                    }

                                    ?>
                                </div>

                                <div class="col-12 mt-3" data-aos="zoom-in" data-aos-duration="1500">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                                </div>
                                <div class="col-12 mt-1" data-aos="zoom-in" data-aos-duration="2000">
                                    <span class="text-white"><?php echo $_SESSION["a"]["email"]; ?></span>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="nav flex-column nav-pills me-3 mt-3" data-aos="zoom-in" data-aos-duration="2000">
                                    <nav class="nav flex-column">
                                        <a class="nav-link fs-5 text-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
                                        <a class="nav-link text-black fs-5 active bg-warning adminNav" href="message.php"><i class="bi bi-chat-dots-fill fs-5"></i> Messages</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="sellingHistory.php"><i class="bi bi-bag-fill fs-5"></i> Selling History</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="#" onclick="signout();"><i class="bi bi-box-arrow-right fs-5"></i> Sign Out</a>
                                    </nav>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- nav -->
                <div class="col-12 d-lg-none" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row">

                        <div class="align-items-start bg-dark col-12">
                            <div class="row g-1 text-center">
                                <div class="col-12 mt-5" data-aos="zoom-in" data-aos-duration="1000">
                                    <?php

                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $email . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;

                                    if ($profile_img_num == 1) {

                                        $profile_img_data = $profile_img_rs->fetch_assoc();

                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" class="rounded-circle" width="90px" height="90px" />
                                    <?php

                                    } else {

                                    ?>
                                        <img src="resourses/profile_img/newuser.svg" class="rounded-circle" width="90px" height="90px" />
                                    <?php

                                    }

                                    ?>
                                </div>

                                <div class="col-12 mt-3" data-aos="zoom-in" data-aos-duration="1500">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                                </div>
                                <div class="col-12 mt-1" data-aos="zoom-in" data-aos-duration="2000">
                                    <span class="text-white"><?php echo $_SESSION["a"]["email"]; ?></span>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="nav flex-column nav-pills me-3 mt-3" data-aos="zoom-in" data-aos-duration="2000">
                                    <nav class="nav flex-column">
                                        <a class="nav-link fs-5 text-warning adminNav" href="adminpanel.php"><i class="bi bi-speedometer2 fs-5"></i> Dashboard</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageUsers.php"><i class="bi bi-file-earmark-person-fill fs-5"></i> Manage Users</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="manageProducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> Manage Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="addproduct.php"><i class="bi bi-bag-fill fs-5"></i> Add New Product</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="myproducts.php"><i class="bi bi-gear-wide-connected fs-5"></i> My Products</a>
                                        <a class="nav-link text-black fs-5 active bg-warning adminNav" href="message.php"><i class="bi bi-chat-dots-fill fs-5"></i> Messages</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="sellingHistory.php"><i class="bi bi-bag-fill fs-5"></i> Selling History</a>
                                        <a class="nav-link text-warning fs-5 adminNav" href="#" onclick="signout();"><i class="bi bi-box-arrow-right fs-5"></i> Sign Out</a>
                                    </nav>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <!-- nav -->

                <!-- header -->
                <div class="offset-lg-2 col-12 col-lg-10 bg-white" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3 text-center">
                                    <h1 class=" fs-1 text-warning fw-bold">Messages</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- header -->

                <div class="offset-lg-2 col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                            <hr />
                        </div>

                        <div class="col-12 px-4">
                            <div class="row overflow-hidden shadow rounded">
                                <div class="col-12 col-lg-5 px-0" data-aos="fade-up-right" data-aos-duration="1000">
                                    <div class="bg-white">
                                        <div class="bg-light px-4 py-2">
                                            <div class="col-12">
                                                <h5 class="mb-0 py-1">Recents</h5>
                                            </div>
                                            <div class="col-12">

                                                <!--  -->
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Received</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sent</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        <div class="message_box" id="message_box">
                                                            <?php

                                                            $msg_rs1 = Database::search("SELECT DISTINCT `from` FROM `msg` WHERE `to`='" . $mail . "' ");
                                                            $msg_num1 = $msg_rs1->num_rows;

                                                            for ($x = 0; $x < $msg_num1; $x++) {
                                                                $msg_data1 = $msg_rs1->fetch_assoc();

                                                                $msg_rs = Database::search("SELECT * FROM `msg` WHERE `from`='" . $msg_data1["from"] . "' ORDER BY `date_time` DESC LIMIT 1 ");
                                                                $msg_num = $msg_rs->num_rows;
                                                                $msg_data = $msg_rs->fetch_assoc();

                                                                if ($msg_data["status"] == 0) {

                                                            ?>
                                                                    <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');" data-aos="fade-up" data-aos-duration="1000">
                                                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">
                                                                            <?php

                                                                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
                                                                            $user_data = $user_rs->fetch_assoc();

                                                                            $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $msg_data["from"] . "'");
                                                                            $img_data = $img_rs->fetch_assoc();

                                                                            ?>
                                                                            <div class="media">
                                                                                <?php

                                                                                if (isset($img_data["path"])) {
                                                                                ?>
                                                                                    <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <img src="resourses/profile_img/newuser.svg" width="50px" class="rounded-circle">
                                                                                <?php
                                                                                }

                                                                                ?>

                                                                                <div class="me-4">
                                                                                    <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                        <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"]; ?></h6>
                                                                                        <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                                                    </div>
                                                                                    <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </a>

                                                                    </div>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');" data-aos="fade-up" data-aos-duration="1000">
                                                                        <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 bg-body">
                                                                            <?php

                                                                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
                                                                            $user_data = $user_rs->fetch_assoc();

                                                                            $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $msg_data["from"] . "'");
                                                                            $img_data = $img_rs->fetch_assoc();

                                                                            ?>
                                                                            <div class="media">
                                                                                <?php

                                                                                if (isset($img_data["path"])) {
                                                                                ?>
                                                                                    <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <img src="resourses/profile_img/newuser.svg" width="50px" class="rounded-circle">
                                                                                <?php
                                                                                }

                                                                                ?>

                                                                                <div class="me-4">
                                                                                    <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                        <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"]; ?></h6>
                                                                                        <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                                                    </div>
                                                                                    <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </a>

                                                                    </div>
                                                            <?php
                                                                }
                                                            }

                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                                        <div class="message_box" id="message_box">
                                                            <?php

                                                            $msg_rs2 = Database::search("SELECT DISTINCT `content`,`date_time`,`status`,`to` FROM `msg` WHERE `from`='" . $mail . "' ORDER BY `date_time` DESC LIMIT 4 ");
                                                            $msg_num2 = $msg_rs2->num_rows;

                                                            for ($y = 0; $y < $msg_num2; $y++) {
                                                                $msg_data2 = $msg_rs2->fetch_assoc();
                                                            ?>
                                                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-0 bg-secondary">
                                                                        <div class="media">
                                                                            <?php

                                                                            $user_rs2 = Database::search("SELECT * FROM `users` WHERE `email`='" . $mail . "'");
                                                                            $user_data2 = $user_rs2->fetch_assoc();

                                                                            $img_rs2 = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $mail . "'");
                                                                            $img_data2 = $img_rs2->fetch_assoc();

                                                                            if (isset($img_data2["path"])) {
                                                                            ?>
                                                                                <img src="<?php echo $img_data2["path"]; ?>" width="50px" class="rounded-circle">
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <img src="resourses//profile_img///newuser.svg" width="50px" class="rounded-circle">
                                                                            <?php
                                                                            }

                                                                            ?>
                                                                            <div class="me-4">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                    <h6 class="mb-0 fw-bold"> me</h6>
                                                                                    <small class="small fw-bold"><?php echo $msg_data2["date_time"]; ?></small>

                                                                                </div>
                                                                                <p class="mb-0"><?php echo $msg_data2["content"]; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </a>

                                                                </div>
                                                            <?php
                                                            }

                                                            ?>

                                                        </div>


                                                    </div>
                                                </div>
                                                <!--  -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-7 px-0">
                                    <div class="row px-4 py-5 text-white chat_box" style="height: 400px; overflow-y: scroll;" id="chat_box">

                                        <!-- view area -->


                                    </div>
                                    <!-- txt -->
                                    <div class="col-12 px-2">
                                        <div class="row">
                                            <div class="text-end">
                                                <img id="upImg" class="mx-5 shadow rounded" style="height: 100px;" />
                                            </div>
                                            <div class="input-group mb-3" data-aos="fade-up-left" data-aos-duration="1000">
                                                <input type="text" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn" id="msg_txt" />
                                                <input class="d-none" type="file" accept="img/*" id="sendimg" />
                                                <label class="btn btn-light fs-2" for="sendimg" onclick="UploadImage();"><i class="fs-1 bi bi-image-fill"></i></label>
                                                <button class="btn btn-light fs-2" id="send_btn" onclick="send_msg();"><i class="bi bi-send-fill fs-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- txt -->
                                </div>

                            </div>
                        </div>

                        <?php include "footer.php"; ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
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
    header("location:adminSignin.php");
}
?>