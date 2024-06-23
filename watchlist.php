<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            include "header.php";


            if (isset($_SESSION["u"])) {


            ?>

                <div class="col-12 mt-5">
                    <div class="row text-center justify-content-center">
                        <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px;" class="mt-5 mb-0">Watchlist</p>
                        <div style="width: 50px;" class="line mt-1"></div>
                    </div>
                </div>

                <div class="col-12">


                    <?php

                    $user = $_SESSION["u"]["email"];


                    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "'");
                    $watch_num = $watch_rs->num_rows;

                    if ($watch_num == 0) {

                    ?>

                        <div class="row bg-light ms-lg-5 me-lg-5 justify-content-center">

                            <div class="col-12 text-center bg-body" style="height: 450px;">
                                <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                                    You have not added any product to watchlist
                                </span>
                                <a href="shop.php" class="btn mt-5 w-25 fw-bold" style="background-color: #00cd27; color: white;">Shop Now</a>
                            </div>
                        </div>

                    <?php

                    } else {
                    ?>

                        <?php
                        for ($x = 0; $x < $watch_num; $x++) {
                            $watch_data = $watch_rs->fetch_assoc();

                        ?>

                            <div class="row bg-light ms-lg-5 me-lg-5 justify-content-center">

                                <div class="col-12 col-lg-4 mb-3 mt-3">

                                    <div class="card p-2" style="max-width: 540px;">
                                        <div class="row g-0 mb-2">
                                            <div class="col-md-4">
                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $watch_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $image_data = $image_rs->fetch_assoc();
                                                ?>
                                                <img src="<?php echo $image_data["name"]; ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">

                                                    <?php

                                                    // $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $watch_data["product_id"] . "' AND `user_email`='" . $user . "'");
                                                    // $product_data = $product_rs->fetch_assoc();


                                                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                    $seller_data = $seller_rs->fetch_assoc();
                                                    $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                                    ?>

                                                    <h5 class="card-title"><?php echo $product_data["title"] ?></h5>
                                                    <p class="card-text"><b>Seller :-</b> &nbsp;&nbsp;&nbsp;<?php echo $seller; ?></p>
                                                    <span class="fs-6 fw-bold text-black-50 ">Rs. <?php echo $product_data["price"]; ?> .00</span>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-6 text-center">
                                                                <button class="btn btn-outline-success w-100 fw-bold">Add to Cart</button>
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <button class="btn btn-outline-danger w-100 fw-bold" onclick='removeFromWatchlist(<?php echo $watch_data["id"] ?>);'>Remove</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        <?php
                        }
                        ?>


                </div>

                <div class="col-12 mb-2">
                    <div class="row d-flex justify-content-center">
                        <button class="btn btn-primary w-75">Cleare Watchlist</button>
                    </div>
                </div>


            <?php
                    }

            ?>



        <?php
            } else {
                echo ("Please Login First");
            }

        ?>

        <?php include "footer.php"; ?>

        </div>

    </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script>
        $('#sidebar1').click(function() {
            $('.ui.sidebar').sidebar('toggle');
        });
    </script>
    <script>
        $('#sidebar2').click(function() {
            $('.ui.sidebar').sidebar('toggle');
        });
    </script>
</body>

</html>