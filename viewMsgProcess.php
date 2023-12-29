<?php

session_start();
require "connection.php";

$recever_mail;
if (isset($_SESSION["u"])) {

    $recever_mail = $_SESSION["u"]["email"];
} else if (isset($_SESSION["a"])) {

    $recever_mail = $_SESSION["a"]["email"];
}

$sender_mail = $_GET["e"];

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
                <div class="rounded py-2 px-3 mb-2 text-end">
                    <?php
                    if ($msg_data["msg_img"] == "0") {
                    } else {
                    ?>
                        <img src="<?php echo $msg_data["msg_img"]; ?>" class="mx-5 shadow rounded" style="height: 300px;" onclick="viewMsgImgModal(<?php echo $msg_data['id']; ?>);" />
                    <?php
                    }
                    ?>
                    <p class="mb-0 text-white"><span class="bg-primary p-2 px-3 rounded"><?php echo $msg_data["content"]; ?></span></p>
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