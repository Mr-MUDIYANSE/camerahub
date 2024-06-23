<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="semantic.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">


            <?php

            if (isset($_SESSION["u"])) {

                $email =  $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
                $user_data = $details_rs->fetch_assoc();

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                $image_data = $image_rs->fetch_assoc();

            ?>
            <?php
            } else {
                header("location:signIn.php");
            }


            ?>

            <div class="col-2">
                <label id="sidebar1" class="item mt-2">
                    <i class="sidebar icon fs-2 text-white"></i>
                </label>
                <div class="ui sidebar vertical left inverted menu">
                    <div class="row d-flex flex-column align-items-center text-center py-3 border border-2">
                        <?php
                        if (empty($image_data["path"])) {
                        ?>
                            <img src="resources/profile_img/new_user.png" class="rounded-circle bg-white" style="width: 140px" ; id="viewImg" />
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle" style="width: 130px" height="110px" ; id="viewImg" />
                        <?php
                        }
                        ?>
                        <label class="mt-2 fw-bold fs-6 text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></label>
                        <label class="mt-1 fw-bold fs-6 text-white">Rs. 150000 .00</label>
                    </div>

                    <div class="row border border-2 navbg">
                        <a href="index.php" class="text-white fw-bold ms-1  fs-4 mt-3"><i class="bi bi-house-fill me-4 txtdec"></i>Home</a>
                        <div class="col-12">
                            <hr>
                        </div>
                        <a href="profile.php" class="text-white fw-bold ms-1  fs-4 mt-3"><i class="bi bi-house-fill me-4"></i>Proile</a>
                        <div class="col-12">
                            <hr>
                        </div>
                        <a href="store.php" class="text-white fw-bold ms-1  fs-4 "><i class="bi bi-shop me-4"></i>Store</a>
                        <div class="col-12">
                            <hr>
                            <a href="#" class="text-white fw-bold ms-1  fs-4 "><i class="bi bi-currency-dollar me-4"></i>My Selling</a>
                            <div class="col-12">
                                <hr>
                            </div>
                            <a href="#" class="text-white fw-bold ms-1  fs-4 "><i class="bi bi-clock-history me-4"></i>History</a>
                            <div class="col-12">
                                <hr>
                            </div>
                            <a href="#" class="text-white fw-bold ms-1  fs-4 "><i class="bi bi-cart2 me-4"></i>Cart</a>
                            <div class="col-12">
                                <hr>
                            </div>
                            <a href="#" class="text-white fw-bold ms-1  fs-4 "><i class="bi bi-heart-fill me-4"></i>Watchlist</a>
                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-warning p-2 mb-2 w-100">Log Out</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <!-- <script src="bootstrap.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script>
        $('#sidebar1').click(function() {
            $('.ui.sidebar').sidebar('toggle');
        });
    </script>
</body>

</html>