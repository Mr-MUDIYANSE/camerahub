<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body>


    <div class="container-fluid">
        <div class="row">


            <?php

            include "header.php";


            if (isset($_SESSION["u"])) {


                $email = $_SESSION["u"]["email"];

                $total = 0;

            ?>

                <div class="col-12" style="margin-top: 70px;">
                    <div class="row">

                        <div class="container">
                            <div class="col-12 mb-5">
                                <div class="row text-center justify-content-center">
                                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 40px;" class="mb-0 mt-3">Cart</p>
                                    <div style="width: 40px;" class="line mt-1"></div>
                                </div>
                            </div>
                        </div>

                        <?php


                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>

                            <div class="col-12 mb-3 border-end border-1">
                                <div class="row justify-content-center mt-3 text-center">

                                    <h1 class="mt-5">Empty Cart</h1>

                                    <div class="col-6 mt-5">
                                        <a href="shop.php" class="btn w-75 fw-bold" style="background-color: #00cd27; color: white;">Shop Now</a>
                                    </div>

                                </div>
                            </div>

                        <?php
                        } else {

                        ?>

                            <div class="col-12 col-lg-7 offset-lg-1 border-end border-1">
                                <div class="row justify-content-center mt-3">


                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["c_qty"]);

                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON
                                    user_has_address.city_id = city_id INNER JOIN `district` ON city.district_id=district.id WHERE 
                                    `user_email` = '" . $email . "'");

                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 350;

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];


                                    ?>

                                        <div class="card mb-3" style="max-width: 500px;">
                                            <div class="row g-0 mb-2">
                                                <div class="col-md-4">

                                                    <?php
                                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $image_data = $image_rs->fetch_assoc();
                                                    ?>

                                                    <img src="<?php echo $image_data["name"]; ?>" class="img-fluid rounded-start" style="height: 150px;" />
                                                </div>
                                                <div class="col-md-8 ps-3">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                                        <p class="card-text"><b>Seller :-</b> &nbsp;&nbsp;&nbsp;<?php echo $seller; ?></p>
                                                        <span class="fs-6 fw-bold text-black-50 ">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                        <span class="ms-4 fw-bold">Qty :- <?php echo $cart_data["c_qty"]; ?></span><i class="bi bi-heart fs-4 offset-2" style="cursor: pointer;" onclick="moveWatchlist();"></i>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row ps-3">

                                                                <div class="col-6 text-center">
                                                                    <button class="btn btn-outline-danger w-100 fw-bold" onclick='removeFromCart(<?php echo $cart_data["id"] ?>);'>Delete</button>
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
                            </div>



                            <div class="col-12 col-lg-4">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-11">
                                        <div class="row bg-light p-3">

                                            <div class="col-12">
                                                <label class="form-label fs-3 fw-bold">Place Your Order</label>
                                            </div>

                                            <div class="col-12">
                                                <hr />
                                            </div>

                                            <div class="col-6 mb-3">
                                                <span class="fs-6 fw-bold">Items (<?php echo $cart_num ?>)</span>
                                            </div>

                                            <div class="col-6 text-end mb-3">
                                                <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="fs-6 fw-bold">Shipping</span>
                                            </div>

                                            <div class="col-6 text-end">
                                                <span class="fs-6 fw-bold">Rs. <?php echo $ship; ?> .00</span>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <hr />
                                            </div>

                                            <div class="col-6 mt-2">
                                                <span class="fs-4 fw-bold">Total</span>
                                            </div>

                                            <div class="col-6 mt-2 text-end mb-4">
                                                <span class="fs-5 fw-bold">Rs. <span id="total"><?php echo $total + $ship ?></span> .00</span>
                                            </div>

                                            <div class="col-12 mt-3 mb-3 d-grid">
                                                <button class="btn bg-black bg-opacity-50 fs-5 text-white fw-bold" onclick="payNowCart();">PROCEED TO CHECKOUT</button>
                                            </div>

                                            <div class="col-12 mt-3 mb-4">
                                                <div class="row justify-content-center gap-4">
                                                    <div class="col-2 i1"></div>
                                                    <div class="col-2 i2"> </div>
                                                    <div class="col-2 i3"></div>
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
                </div>

                <?php include "footer.php"; ?>
            <?php
            } else {
                header("location:signIn.php");
            }
            ?>
        </div>
    </div>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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