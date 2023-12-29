<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title></title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- nav -->
    <div class="col-12 d-none d-lg-block bg-light bg-opacity-25 shadow">
        <div class="row">
            <nav class="navbar p-0">
                <div class="container-fluid col-12 col-lg-8 offset-lg-2">
                    <a class="navbar-brand p-0" href="home.php">
                        <img src="resourses/logo.png" alt="Logo" height="32" class="d-inline-block align-text-top">
                        <span class="fs-1 fw-bold text-black navTitle">Desert</span>
                    </a>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="fs-5 nav-link nav_item text-black" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="fs-5 nav-link nav_item text-black" href="home.php#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="fs-5 nav-link nav_item text-black" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="fs-5 nav-link nav_item text-black" href="#contact">Contact</a>
                        </li>
                        <?php
                        if (isset($_SESSION["u"])) {
                        ?>
                            <li class="nav-item">
                                <div class="col-2 col-lg-6 dropdown" style="list-style: none;">
                                    <button class="btn dropdown-toggle fs-5" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        My Dashboard
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                                        <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                        <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                        <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                                        <li><a class="dropdown-item" href="reqproduct.php">Messages</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="fs-5 nav-link nav_item" href="#" onclick="signout();"><i class="bi bi-box-arrow-right fs-5"></i></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="fs-5 nav-link nav_item" href="index.php">Sign In | Register</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>

                </div>
            </nav>
        </div>
    </div>
    <!-- nav -->

    <!-- nav -->
    <div class="col-12 d-block d-lg-none">
        <div class="row">

            <nav class="navbar p-0">
                <div class="container-fluid col-12 col-lg-8 offset-lg-2">
                    <a class="navbar-brand p-0" href="#">
                        <img src="resourses/logo.png" alt="Logo" height="32" class="d-inline-block align-text-top">
                        <span class="fs-1 fw-bold text-black navTitle">Desert</span>
                    </a>

                    <button class="bi bi-list fs-3 border-0 bg-black bg-opacity-10 rounded justify-content-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></button>

                    <div class="offcanvas offcanvas-start bg-light bg-opacity-75" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h4 class="offcanvas-title" id="offcanvasExampleLabel">Desert</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <hr class="form-control">
                        <div class="offcanvas-body">
                            <ul class="nav justify-content-end d-inline">
                                <li class="nav-item">
                                    <a class="fs-4 fw-bold nav-link nav_item" aria-current="page" href="home.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="fs-4 fw-bold nav-link nav_item" href="home.php#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="fs-4 fw-bold nav-link nav_item" href="shop.php">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="fs-4 fw-bold nav-link nav_item" href="#contact">Contact</a>
                                </li>
                                <?php
                                if (isset($_SESSION["u"])) {
                                ?>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" href="userprofile.php">My Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" href="cart.php">Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" href="watchlist.php">WatchList</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" href="purchasingHistory.php">purchasing History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" href="reqproduct.php">Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" onclick="signout();">Sign Out</a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="nav-item">
                                        <a class="fs-4 fw-bold nav-link nav_item" href="index.php">Sign In | Register</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </nav>

        </div>
    </div>
    <!-- nav -->
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>