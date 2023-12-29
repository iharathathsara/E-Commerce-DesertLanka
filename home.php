<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home | Dessert</title>

    <link rel="icon" href="resourses/logo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body style="background-color: #ffff80;">
    <div class="container-fluid">
        <div class="row">

            <!-- nav -->
            <?php require "headder.php"; ?>
            <!-- nav -->
            <div class="bg-area"></div>
            <div class="bg-area layer-2"></div>
            <div class="bg-area layer-3"></div>
            <!-- carousel -->
            <div class="col-12 offset-lg-1 col-lg-10 mt-3">
                <div class="row">
                    <div id="carouselExampleDark" data-aos="zoom-in" data-aos-duration="1000" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="resourses/bgimg/bgimg3.jpg" class="d-block w-100" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Desert</h5>
                                    <p>Cool down your busy day.</p>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="resourses/bgimg/bgimg2.jpg" class="d-block w-100" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Desert</h5>
                                    <p>Live life happily.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resourses/bgimg/bgimg1.jpg" class="d-block w-100" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Desert</h5>
                                    <p>Happy Shop.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
            <!-- carousel -->
            <div class="offset-1 col-10 ">
                <div class="row">
                    <hr class="mt-5" />
                    <!-- about -->
                    <div class="col-12 mt-lg-3" id="about">
                        <div class="row">
                            <div class="col-12 mb-5" data-aos="fade-up" data-aos-duration="1000">
                                <div class="row">
                                    <span class="col-12 d-none d-lg-block text-center fw-bold" style="font-size: 64px;">About Us</span>
                                    <span class="col-12 d-lg-none text-center fs-1 fw-bold">About Us</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6 d-none d-lg-block aboutImg" data-aos="fade-right" data-aos-duration="1000"></div>

                                    <div class="col-12 d-none col-lg-6 d-lg-block" data-aos="fade-left" data-aos-duration="1000">
                                        <div class="row">
                                            <p style="margin-top: 100px; margin-bottom: 100px;">When hunger strikes, #CallFatBoys! If there’s one thing we know better than anything else it’s how to make tasty food. From Sri Lankan classics to tasty bites, juicy burgers to Fat Boys Kottu, we’re here delivering 5 star rated food to people across Galle.</p>
                                        </div>
                                    </div>

                                    <div class="col-12 d-lg-none" data-aos="fade-left" data-aos-duration="1000">
                                        <div class="row">
                                            <p style="margin-bottom: 100px;">When hunger strikes, #CallFatBoys! If there’s one thing we know better than anything else it’s how to make tasty food. From Sri Lankan classics to tasty bites, juicy burgers to Fat Boys Kottu, we’re here delivering 5 star rated food to people across Galle.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- about -->
                    <div class="offset-2 col-8 text-center my-lg-5" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="row">
                            <p>Freshly made with no artificial ingredients, low sugar and unnecessary additives. We do not use sugar or sugar-based syrups to flavor any of our beverages. We only use all natural ingredients that your body can recognize and use.</p>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="col-12 text-center my-5 py-3" style="background-color: #ffffcc; background-image: linear-gradient(90deg,#ffffcc 0%,#ffff80 100% );">
                        <div class="row">
                            <div class="offset-4 col-4 offset-lg-5 col-lg-2" data-aos="flip-up" data-aos-duration="1000">
                                <div class="row">
                                    <img src="resourses/delivery.png" />
                                </div>
                            </div>
                            <div class="offset-2 col-8" data-aos="fade-up" data-aos-duration="1000">
                                <div class="row">
                                    <p class="my-4">Place your orders today or pre-order for your parties and special occasions</p>
                                    <p class="my-4">Desert Galle – Delicious Sri Lanka Take Away</p>
                                    <p class="my-4">Kottu Take Away • Hot Pot Biriyani Take Away • Roti Take Away • Seafood Special Take Away • Banana Leaf Special Take Away • Sawan Party Take Away • Tasty Bites Take Away • Deserts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <hr class="my-5" /> -->
                </div>
            </div>
            <!-- footter -->
            <?php require "footer.php"; ?>
            <!-- footter -->
        </div>
    </div>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>