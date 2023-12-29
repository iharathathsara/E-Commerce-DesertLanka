<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {
    $txt = $_GET["txt"];

?>

    <div class="row">

        <?php

        $query = "SELECT * FROM `users` WHERE `fname` LIKE '%" . $txt . "%' OR `lname` LIKE '%" . $txt . "%'";
        $pageno;


        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }

        $user_rs = Database::search($query);
        $user_num = $user_rs->num_rows;

        $results_per_page = 10;
        $number_of_pages = ceil($user_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;

        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();

        ?>

            <div class="col-12">
                <div class="row">
                    <div class="col-2 col-lg-1 border py-2 text-end">
                        <span class="fs-6 fw-bold"><?php echo $x + 1; ?></span>
                    </div>
                    <?php
                    $user_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $selected_data["email"] . "'");
                    $userImg_num = $user_image_rs->num_rows;
                    if ($userImg_num == 0) {
                    ?>
                        <div class="col-1 d-none d-lg-block border py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>','<?php echo $x; ?>');" style="cursor: pointer;">
                            <img src="resourses/profile_img/newuser.svg" style="height: 40px; margin-left: 20px;" />
                        </div>
                    <?php
                    } else {
                        $userImg_data = $user_image_rs->fetch_assoc();

                    ?>
                        <div class="col-1 d-none d-lg-block border py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>','<?php echo $x; ?>');" style="cursor: pointer;">
                            <img src="<?php echo $userImg_data["path"] ?>" style="height: 40px; margin-left: 20px;" />
                        </div>
                    <?php
                    }
                    ?>

                    <div class="col-4 col-lg-2 border py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>','<?php echo $x; ?>');" style="cursor: pointer;">
                        <span class="fs-6 fw-bold"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                    </div>
                    <div class="col-4 col-lg-3 d-lg-block border py-2">
                        <span class="fs-6 fw-bold"><?php echo $selected_data["email"] ?></span>
                    </div>
                    <div class="col-2 d-none d-lg-block border py-2">
                        <span class="fs-6 fw-bold"><?php echo $selected_data["mobile"] ?></span>
                    </div>
                    <div class="col-2 d-none d-lg-block border py-2">
                        <span class="fs-6 fw-bold"><?php echo $selected_data["joined_date"] ?></span>
                    </div>
                    <div class="col-2 col-lg-1 border py-2 d-grid">
                        <?php

                        if ($selected_data["status"] == 1) {
                        ?>
                            <button class="btn btn-danger" id="ub<?php echo $selected_data['email']; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-success" id="ub<?php echo $selected_data['email']; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                        <?php
                        }

                        ?>

                    </div>
                </div>
            </div>

            <!-- msg modal -->
            <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo $selected_data['fname'] . " " . $selected_data["lname"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body overflow-scroll" id="admin<?php echo $x; ?>">

                        </div>
                        <div class="modal-footer">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="msgtxt<?php echo $x; ?>" placeholder="type..." />
                                    </div>
                                    <div class="col-3 d-grid">
                                        <button type="button" class="btn btn-primary" onclick="sendAdminMsg('<?php echo $selected_data['email'] ?>','msgtxt<?php echo $x; ?>')">Send</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- msg modal -->

        <?php

        }

        ?>

        <!--  -->
        <div class="offset-2 offset-lg-5 col-8 col-lg-2 mt-3 mb-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center d-inline">
                    <li class="page-item">
                        <a class="page-link" href="<?php if ($pageno <= 1) {
                                                        echo ("#");
                                                    } else {
                                                        echo "?page=" . ($pageno - 1);
                                                    } ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php

                    for ($x = 1; $x <= $number_of_pages; $x++) {
                        if ($x == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>

                    <li class="page-item">
                        <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                        echo ("#");
                                                    } else {
                                                        echo "?page=" . ($pageno + 1);
                                                    } ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--  -->
    </div>

<?php

} else {
    header("location:adminSignin.php");
}
?>