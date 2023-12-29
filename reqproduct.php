<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages | Dessert</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" href="resourses/logo.png" />
</head>

<body style="background-color: #ffffcc; background-image: linear-gradient(90deg,#ffffcc 0%,#ffff80 100% );">
    <div class="container-fluid">
        <div class="row">
            <?php include "headder.php";
            require "connection.php";

            if (isset($_SESSION["u"])) {

                $mail = $_SESSION["u"]["email"];
            ?>

                <div class="bg-area"></div>
                <div class="bg-area layer-2"></div>
                <div class="bg-area layer-3"></div>
                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12">
                    <span class="fw-bold" hidden id="rmail"><?php echo $mail; ?></span>
                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row overflow-hidden shadow rounded">

                        <div class="col-12 px-2 py-1">

                            <div class="row px-4 py-5 text-white chat_box" id="chat_box" style="background-color: #ffffcc; background-image: linear-gradient(-90deg,#ffffcc 0%,#ffff80 100% );">

                                <!-- view area -->

                                <?php
                                $admin_rs = Database::search("SELECT * FROM `admin`");
                                $admin_data = $admin_rs->fetch_assoc();
                                $sender_mail = $admin_data["email"];

                                $recever_mail = $_SESSION["u"]["email"];

                                $msg_rs = Database::search("SELECT * FROM `msg` WHERE `from`='" . $sender_mail . "' OR `to`='" . $sender_mail . "'");
                                $msg_num = $msg_rs->num_rows;

                                for ($x = 0; $x < $msg_num; $x++) {
                                    $msg_data = $msg_rs->fetch_assoc();

                                    if ($msg_data["from"] == $sender_mail && $msg_data["to"] == $recever_mail) {

                                        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $msg_data["from"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                ?>
                                        <!-- sender -->
                                        <div class="media mb-3 w-75">
                                            <?php
                                            if (isset($img_data["path"])) {
                                            ?>
                                                <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src="resourses/profile_img/newuser.svg" width="50px" class="rounded-circle" />
                                            <?php
                                            }
                                            ?>
                                            <div class="media-body me-4">
                                                <div class="rounded py-2 px-3 mb-2">
                                                    <?php
                                                    if ($msg_data["msg_img"] == "0") {
                                                    } else {
                                                    ?>
                                                        <img src="<?php echo $msg_data["msg_img"]; ?>" class="mx-5 shadow rounded" style="height: 300px;" onclick="viewMsgImgModal(<?php echo $msg_data['id']; ?>);" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <p class="mb-0 fw-bold text-black-50"><span class="bg-light p-2 px-3 rounded"><?php echo $msg_data["content"]; ?></span></p>
                                                </div>
                                                <p class="small fw-bold text-black-50"><?php echo $msg_data["date_time"]; ?></p>
                                                <p class="invisible" id="rmail"><?php echo $msg_data["from"]; ?></p>
                                            </div>
                                        </div>
                                        <!-- sender -->
                                    <?php
                                    } else if ($msg_data["to"] == $sender_mail && $msg_data["from"] == $recever_mail) {
                                    ?>
                                        <!-- receiver -->
                                        <div class="media mb-3 w-75 offset-3 col-9">
                                            <div class="media-body">
                                                <div class="text-end rounded py-2 px-3 mb-2">
                                                    <?php
                                                    if ($msg_data["msg_img"] == "0") {
                                                    } else {
                                                    ?>
                                                        <img src="<?php echo $msg_data["msg_img"]; ?>" class="mx-5 shadow rounded" style="height: 300px;" onclick="viewMsgImgModal(<?php echo $msg_data['id']; ?>);" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <p class="mb-0 text-black"><span class="bg-warning p-2 px-3 rounded"><?php echo $msg_data["content"]; ?></span></p>
                                                </div>
                                                <p class="small fw-bold text-black-50 text-end"><?php echo $msg_data["date_time"]; ?></p>
                                            </div>
                                        </div>
                                        <!-- receiver -->
                                    <?php
                                    }
                                    if ($msg_data["status"] == 0) {
                                        Database::iud("UPDATE `msg` SET `status`='1' WHERE `from`='" . $sender_mail . "' AND `to`='" . $recever_mail . "'");
                                    }
                                    ?>
                                    <!-- model 1 -->
                                    <div class="modal" tabindex="-1" id="viewMsgImgModal<?php echo $msg_data['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <img src="<?php echo $msg_data['msg_img']; ?>" style="height: 400px;" class="img-fluid" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal 1 -->
                                <?php
                                }
                                ?>
                                <!-- view area -->
                            </div>
                            <div class="row">
                                <div class="text-end">
                                    <img id="upImg" class="mx-5 shadow rounded" style="height: 100px;" />
                                </div>
                                <div class="input-group mb-3" data-aos="zoom-in" data-aos-duration="1000">
                                    <input type="text" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn" id="msg_txt" />
                                    <input class="d-none" type="file" accept="img/*" id="sendimg" />
                                    <label class="btn btn-light fs-2" for="sendimg" onclick="UploadImage();"><i class="fs-1 bi bi-image-fill"></i></label>
                                    <button class="btn btn-light fs-2" id="send_btn" onclick="sendmsg();"><i class="bi bi-send-fill fs-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr />
                </div>
                <?php include "footer.php";
                ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
<?php
            } else {
?>
    <script>
        alert("Please Sing in or Register first");
        window.location = "index.php";
    </script>
<?php
            }
?>
</body>