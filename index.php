<!DOCTYPE html>
<html>

<head>
    <title>Sign In | Dessert</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resourses/logo.png" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body class="main-body" style="background-color: #ffffcc;">
    <div class="bg-area"></div>
    <div class="bg-area layer-2"></div>
    <div class="bg-area layer-3"></div>
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">
            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo" data-aos="zoom-in" data-aos-duration="1000"></div>
                    <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                        <p class="text-center title1">Hi, Welcome to Desert</p>
                    </div>
                </div>
            </div>
            <!-- header -->
            <!-- content1 -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background" data-aos="fade-up-right" data-aos-duration="1000"></div>
                    <div class="col-12 col-lg-6 rounded-3 shadow p-3" data-aos="fade-up-left" data-aos-duration="1000" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12" data-aos="fade-left" data-aos-duration="1000">
                                <p class="title02">Create New Account</p>
                                <span class="text-danger" id="msg"></span>
                            </div>

                            <div class="col-6" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" id="fname" placeholder="Ex : Tom" />
                            </div>

                            <div class="col-6" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" id="lname" placeholder="Ex : John" />
                            </div>

                            <div class="col-12" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="email" placeholder="Ex : tomjohn@gmail.com" />
                            </div>

                            <div class="col-12" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" placeholder="Ex : ******" />
                            </div>

                            <div class="col-6" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">Mobile</label>
                                <input class="form-control" type="text" id="mobile" placeholder="Ex : (+94)123456789" />
                            </div>

                            <div class="col-6" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">

                                    <?php
                                    require "connection.php";
                                    $resultset = Database::search("SELECT * FROM `gender`");
                                    $n = $resultset->num_rows;
                                    for ($x = 0; $x < $n; $x++) {
                                        $f = $resultset->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $f["id"]; ?>"><?php echo $f["gender_name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-none rounded p-3 shadow" id="signInBox" data-aos="fade-up-left" data-aos-duration="1000">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In to your account..</p>
                                <span class="text-danger" id="msg2"></span>
                            </div>
                            <?php
                            $email = "";
                            $password = "";
                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }
                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }
                            ?>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="email2" value="<?php echo $email; ?>" />
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password2" value="<?php echo $password; ?>" />
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="rememberMe">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to Desert? Join Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content1 -->
            <!-- model -->
            <div class="modal" tabindex="-1" id="fogotPasswordModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" placeholder="New Password" />
                                        <button class="btn btn-secondary" type="button" id="npb" onclick="showpassword1();"><i class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" placeholder="Re-Type New Password" />
                                        <button class="btn btn-secondary" type="button" id="rnpb" onclick="showpassword2();"><i class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Verification Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="vc" placeholder="Verification Code" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model -->
            <!-- Fotter -->
            <div class="col-12 fixed-bottom d-none d-lg-block" data-aos="fade-up" data-aos-duration="1000">
                <p class="text-center">&copy; 2022 Desert.lk || All Rights Reserved.</p>
            </div>
            <!-- Fotter -->
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