<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="semantic.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />

</head>

<body>

    <div class="container-fluid">
        <div class="row mt-5">

            <?php include "header.php"; ?>

            <div class="col-12">
                <div class="row">
                    <div id="carouselExampleIndicators" class="carousel slide p-0 " data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active  imgslider1">
                                <div class="slider_content offset-1">
                                    <div class="ps-2 mb-5" style="border: solid; border-color: black; border-top: none; border-right: none; border-bottom: none; border-width: 3px; width: 100px;">
                                        <span class="text-white fw-semibold">Camera From <br /> <span class="fw-bold">CAMERAHUB</span> </span>
                                    </div>
                                    <label class="text-white mb-5 fw-normal" style="font-size: 70px;">BEST </label><br />
                                    <span style="font-size: 70px; margin-top: 500px;" class="text-white fw-semibold">Solutions</span>
                                    <p class="text-white mt-3 fs-4">Discount 20% Off For camerahub.lk </p>
                                    <a href="shop.php"><button class="discover-btn" href="shop.php">Discover Now </button></a>
                                </div>
                            </div>
                            <div class="carousel-item w-100 imgslider2">
                                <div class="slider_content offset-1">
                                    <div class="ps-2 mb-5" style="border: solid; border-color: black; border-top: none; border-right: none; border-bottom: none; border-width: 3px; width: 100px;">
                                        <span class="text-white fw-semibold">Camera From <br /> <span class="fw-bold">CAMERAHUB</span> </span>
                                    </div>
                                    <label class="text-white mb-5 fw-normal" style="font-size: 70px;">BEST </label><br />
                                    <span style="font-size: 70px; margin-top: 500px;" class="text-white fw-semibold">Solutions</span>
                                    <p class="text-white mt-3 fs-4">Discount 20% Off For camerahub.lk </p>
                                    <a href="shop.php"><button class="discover-btn" href="shop.php">Discover Now </button></a>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row text-center justify-content-center">
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 50px;" class="mt-5 mb-0">Our Services</p>
                    <div style="width: 100px;" class="line mt-1"></div>
                </div>
            </div>

            <!--shipping area start-->
            <div class="col-12">
                <div class="justify-content-center d-flex mt-5">
                    <div class="row">

                        <div class="col-lg-4 col-md-6 pe-3">
                            <div class="d-flex">
                                <div class="d-flex justify-content-center me-3">
                                    <img src="resources/shipping1.png" alt="" class="mt-4" style="height: 40px;">
                                </div>
                                <div class="shipping_content">
                                    <h3>Free Delivery</h3>
                                    <p>Free shipping around the world for all <br> orders over $120</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 pe-3">
                            <div class="d-flex col_2">
                                <div class="d-flex justify-content-center me-3">
                                    <img src="resources/shipping2.png" alt="" class="mt-4" style="height: 40px;">
                                </div>
                                <div class="shipping_content">
                                    <h3>Safe Payment</h3>
                                    <p>With our payment gateway, don’t worry about your information</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pe-3">
                            <div class="d-flex col_3">
                                <div class="d-flex justify-content-center me-3">
                                    <img src="resources/shipping3.png" alt="" class="mt-4" style="height: 40px;">
                                </div>
                                <div class="shipping_content">
                                    <h3>Friendly Services</h3>
                                    <p>You have 30-day return guarantee for <br> every single order</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--shipping area end-->

            <div class="col-12 mt-3">
                <div class="row ps-4 justify-content-center text-center">
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 50px;" class="mt-5 mb-0">Featured Products</p>
                    <div style="width: 100px;" class="line mt-1"></div>


                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8">
                                <div class="row w-100">

                                    <?php

                                    $c_rs = Database::search("SELECT * FROM `category`");
                                    $c_num  = $c_rs->num_rows;

                                    for ($b = 0; $b < $c_num; $b++) {
                                        $c_data = $c_rs->fetch_assoc();

                                    ?>

                                        <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
                                            <div class="carousel-inner">

                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `category` ON 
                                                product.id=category.id WHERE `category_id`='" . $c_data["id"] . "' AND
                                            `deal_id`='1' ORDER BY `datetimee_added` DESC LIMIT 4 OFFSET 0");
                                                $product_num = $product_rs->num_rows;

                                                for ($a = 0; $a < $product_num; $a++) {
                                                    $product_data = $product_rs->fetch_assoc();

                                                ?>

                                                    <div class="carousel-item active sideimgslider text-center">
                                                        <label class="mt-2 fw-bold fs-4 text-primary"><?php echo $product_data["name"]; ?></label>
                                                        <div class="ui card w-100">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <div class="ui slide masked reveal image dealimg offset-3 mt-5">
                                                                        <?php
                                                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                                        $image_data = $image_rs->fetch_assoc();
                                                                        ?>
                                                                        <img src="<?php echo $image_data["name"]; ?>" class="content img-size" style="height: 150px;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-8 mt-5">
                                                                    <div class="content text-center">

                                                                        <?php

                                                                        $price = $product_data["price"];
                                                                        $adding_price = ($price / 100) * 25;
                                                                        $new_price = $price + $adding_price;
                                                                        $difference = $new_price - $price;
                                                                        $percentage = ($difference / $price) * 100;

                                                                        ?>
                                                                        <label class="fw-bold fs-5"><?php echo $product_data["title"]; ?></label><br><br>
                                                                        <label class="fs-5 fw-bold form-label">Rs. <?php echo $price; ?> .00</label>&nbsp;&nbsp;&nbsp;
                                                                        <label class="text-danger text-decoration-line-through">Rs. <?php echo $new_price; ?> .00</label><br><br>
                                                                        <label class="fw-bold form-label text-primary mb-2"><?php echo $product_data["qty"]; ?> Items Available</label><br>
                                                                        <label></label>
                                                                        <button class="btn btn-warning mb-3 w-75">Buy Now</button>
                                                                    </div>
                                                                    <div class="extra content text-center mb-2">
                                                                        <label>0 : 0 : 00 : 00</label>
                                                                    </div>
                                                                    <div class="content text-center">
                                                                        <a class="ui red tag label">Save Rs. <?php echo $difference; ?> .00 &nbsp;&nbsp;<?php echo $percentage; ?> %</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ----------------------------------------------------------- -->
                                                <?php
                                                }

                                                ?>
                                            </div>

                                        </div>

                                    <?php
                                    }


                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="row">
                    <?php

                    $c_rs = Database::search("SELECT * FROM `category`");
                    $c_num  = $c_rs->num_rows;

                    for ($b = 0; $b < $c_num; $b++) {
                        $c_data = $c_rs->fetch_assoc();

                    ?>


                </div>
                <div class="row mt-3 justify-content-lg-between ps-5 pe-5">
                    <!--------------------------------------------------------------->

                    <?php

                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c_data["id"] . "' AND
                    `status_id`='1' ORDER BY `datetimee_added` DESC LIMIT 4 OFFSET 0");
                        $product_num = $product_rs->num_rows;

                        for ($z = 0; $z < $product_num; $z++) {
                            $product_data = $product_rs->fetch_assoc();

                    ?>
                        <div class="card homecategorcard" style="width: 18rem; cursor: pointer;">
                            <?php
                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                            $image_data = $image_rs->fetch_assoc();
                            ?>
                            <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="text-black" style="text-decoration: none;">
                                <img src="<?php echo $image_data["name"]; ?>" class="card-img-top productcard" style="height: 200px;" />
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                    <p class="card-text">Rs. <?php echo $product_data["price"]; ?> .00</p>
                            </a>

                        </div>
                </div>
            <?php
                        }

            ?>

        <?php
                    }

        ?>

        <div class="row text-center justify-content-center mb-5">
            <p style="font-family: 'Times New Roman', Times, serif; font-size: 40px;" class="mt-5 mb-0">Get <span style="color: #00cd27;">20% Off</span> Your Next Order</p>
            <div style="width: 200px;" class="line mt-1"></div>
        </div>

            </div>
        </div>

        <?php include "footer.php"; ?>

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