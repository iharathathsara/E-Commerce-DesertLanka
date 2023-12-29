<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Desert | Admins | Sign In</title>

    <link rel="icon" href="resourses/logo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body style="background-color: #ffffcc; background-image: linear-gradient(90deg,#ffffcc 0%,#ffff80 100% );">

    <div class="bg-area"></div>
    <div class="bg-area layer-2"></div>
    <div class="bg-area layer-3"></div>

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center">

            <div class="col-12" data-aos="zoom-in" data-aos-duration="1000">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to Desert Admins.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-6 d-none d-lg-block background" data-aos="fade-up-right" data-aos-duration="1000"></div>

                    <div class="col-12 col-lg-6 d-block" data-aos="fade-up-left" data-aos-duration="1000">
                        <div class="row g-3">

                            <div class="col-12" data-aos="fade-left" data-aos-duration="1000">
                                <p class="title02">Sign In To Your Account.</p>
                            </div>

                            <div class="col-12" data-aos="fade-left" data-aos-duration="1000">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="em" placeholder="john@gmail.com" />
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminVerification();">
                                    Send Verification Code to Login
                                </button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="backToSignIn();">Back to Customer Login</button>
                            </div>

                        </div>
                    </div>

                    <!-- modal-- -->
                    <div class="modal" tabindex="-1" id="verificationModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Admin Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Enter the verification code you got by an email</label>
                                    <input type="text" class="form-control" id="vcode" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal-- -->

                </div>
            </div>

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