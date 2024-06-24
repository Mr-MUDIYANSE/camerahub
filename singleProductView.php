<?php
include "header.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id, product.price,product.qty,product.description,product.title,
        product.datetimee_added,product.category_id,product.modal_has_brand_id,
        product.color_id,product.status_id,product.user_email,
        modal.name AS mname,brand.name AS bname FROM `product` INNER JOIN `modal_has_brand` ON
        modal_has_brand.id=product.modal_has_brand_id INNER JOIN `brand` ON brand.id=modal_has_brand_id INNER JOIN
        `modal` ON modal.id=modal_id WHERE product.id= '" . $pid . "'");


    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $product_data["title"]; ?> | Onliner</title>
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="icon" href="resources/logo.png" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row mt-5">

                    <div class="co-12 mt-5 bg-white mb-3">

                        <div class="row">

                            <div class="col-12 col-lg-4 d-grid justify-content-center p-3">
                                <div style="height: 250px;" class="img-thumbnail mt-1 mb-1 maingsinglimg" id="main_img"></div>
                                <div class="col-12 d-flex justify-content-center">

                                    <?php

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                    $image_num = $image_rs->num_rows;
                                    $img = array();

                                    if ($image_num != 0) {

                                        for ($x = 0; $x < $image_num; $x++) {
                                            $image_data = $image_rs->fetch_assoc();
                                            $img[$x] = $image_data["name"];
                                    ?>

                                            <li class="d-flex flex-column justify-content-center align-items-center border mb-1">
                                                <img src="<?php echo $img["$x"]; ?>" style="height: 80px;" width="100px" class="mb-1 p-2 gap-2 active" id="productImg<?php echo $x; ?>" onload="loadMainImg(<?php echo $x; ?>);" />
                                            </li>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <li class="d-flex flex-column justify-content-center align-items-center border mb-1">
                                            <img src="resources/empty.svg" class="mt-1 mb-1" />
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center border mb-1">
                                            <img src="resources/empty.svg" class="mt-1 mb-1" />
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center border mb-1">
                                            <img src="resources/empty.svg" class="mt-1 mb-1" />
                                        </li>
                                    <?php
                                    }

                                    ?>



                                </div>
                            </div>

                            <div class="col-12 col-lg-5 p-3 mt-1 offset-1 offset-lg-0">
                                <span class="fs-3"><?php echo $product_data["title"]; ?></span><br>

                                <span class="badge p-0 mt-3 mb-4">
                                    <i class="bi bi-star-fill text-warning "></i>
                                    <i class="bi bi-star-fill text-warning "></i>
                                    <i class="bi bi-star-fill text-warning "></i>
                                    <i class="bi bi-star-fill text-warning "></i>
                                    <i class="bi bi-star-fill text-warning "></i>
                                    &nbsp;&nbsp;
                                    <label class=" text-primary">4.5 Stars | 39 Reviews & Ratings</label>
                                </span>

                                <div class="row border-dark">
                                    <div class="col-12 my-2">
                                        <span><b>Condition : </b><span class="text-primary">Brand New</span></span> &nbsp;|&nbsp;
                                        <span><b>Warrenty : </b><span class="text-primary">2 Year Warrenty</span></span><br>
                                        <span><b>Return Time : </b><span class="text-primary me-3">7 Days</span></span>&nbsp;|&nbsp;
                                        <span><b>In Stock : </b><span class="text-primary"><?php echo $product_data["qty"]; ?> Items Available</span></span><br>
                                    </div>
                                </div>

                                <hr class="mb-lg-5 mt-lg-2">

                                <?php

                                $price = $product_data["price"];
                                $adding_price = ($price / 100) * 5;
                                $new_price = $price + $adding_price;
                                $difference = $new_price - $price;
                                $percentage = ($difference / $price) * 100;

                                ?>

                                <span class="fs-3 text-danger fw-bold">Rs. <?php echo $price; ?>.00</span>

                                <i class="bi bi-share-fill offset-5"></i>
                                <i class="bi bi-heart offset-1 watchlist-icon" id="heart" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'></i><br>
                                <span class="fs-6 fw-bold text-black-50 text-decoration-line-through">Rs. <?php echo $new_price; ?> .00</span>
                                <span class="fs-6 fw-bold ms-3 text-danger"><?php echo $percentage; ?> %</span>

                                <!-- qty input -->
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="row">
                                                <label for="">Quantity :-</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="row input-group input-group-sm ">
                                                <input type="number" class="form-control" value="1" id="qty_input" max="<?php echo $product_data["qty"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- qty input end -->

                                <div class="col-12 mt-4">
                                    <div class="row">

                                        <?php

                                        if ($product_data["qty"] > 0) {

                                        ?>
                                            <div class="col-12 col-lg-6 text-lg-center ms-lg-0 ms-3">
                                                <button class="btn btn-primary fw-bold w-75 mt-2 mb-2" onclick="payNow(<?php echo $pid ?>);">Buy Now</button>
                                            </div>
                                            <div class="col-12 col-lg-6 text-lg-center ms-lg-0 ms-3">
                                                <button class="btn btn-warning fw-bold text-white w-75 mt-2 mb-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add To Cart</button>
                                            </div>
                                        <?php

                                        } else {
                                        ?>
                                            <div class="col-12 col-lg-6 text-lg-center ms-lg-0 ms-3">
                                                <button class="btn btn-secondary fw-bold w-75 mt-2 mb-2" disabled>Buy Now</button>
                                            </div>
                                            <div class="col-12 col-lg-6 text-lg-center ms-lg-0 ms-3">
                                                <button class="btn btn-secondary fw-bold text-white w-75 mt-2 mb-2" disabled>Add To Cart</button>
                                            </div>

                                            <div class="col-12 text-center">
                                                <label class="fs-4 fw-bold text-danger mt-5">Out Of Stock</label>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                            </div>

                            <?php

                            if (isset($_SESSION["u"])) {
                            ?>
                                <div class="col-12 col-lg-3 p-2">
                                    <div class="row mt-2 border bg-light pb-2 pt-2">
                                        <div class="col-12 ms-2">
                                            <span class="text-black-50" style="font-size: 13px;">Delivery</span>
                                            <br><br>


                                            <?php

                                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE user_email='" . $_SESSION["u"]["email"] . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            ?>

                                            <div class="row">
                                                <div class="col-1">
                                                    <span><i class="bi bi-geo-alt"></i></span>
                                                </div>

                                                <div class="col-11">
                                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br>
                                                </div>
                                            </div>

                                            <br>

                                            <?php

                                            $mobile_rs = Database::search("SELECT * FROM `user` WHERE email='" . $_SESSION["u"]["email"] . "'");
                                            $mobile_data = $mobile_rs->fetch_assoc();

                                            ?>

                                            <div class="row">
                                                <div class="col-1">
                                                    <span><i class="bi bi-telephone"></i></i></span>
                                                </div>

                                                <div class="col-11">
                                                    <span><?php echo $mobile_data["mobile"]; ?></span><br>
                                                </div>
                                            </div>

                                            <a href="profile.php" class="offset-9 text-primary" style="cursor: pointer;">Change</a>
                                            <hr>
                                            <span><i class="bi bi-truck"></i>&nbsp;&nbsp; Standard Delivery</span><br>
                                            <span class="ms-4 text-black-50" style="font-size: 13px;">4 - 5 Days</span>
                                            <span class="offset-6"><b> Rs. 350</b></span>
                                            <br>
                                            <span><i class="bi bi-wallet2"></i>&nbsp;&nbsp; Cash on Delivery Available</span>
                                            <hr>

                                            <span class=" text-black-50" style="font-size: 13px;">Service</span>
                                            <br><br>
                                            <span><i class="bi bi-arrow-counterclockwise"></i>&nbsp;&nbsp;7 Days Return</span><br>
                                            <span class="ms-4 text-black-50" style="font-size: 12px;">change of mind is not applicable</span>
                                            <br>
                                            <span><i class="bi bi-award mt-1"></i>&nbsp;&nbsp;1 Year Warranty</span><br>
                                        </div>
                                    </div>

                                    <div class="row mt-3 bg-light border  pb-2 pt-2">
                                        <span class="mt-2 text-black-50" style="font-size: 13px;">Sold By</span>
                                        <br><br>

                                        <?php

                                        $user_rs = Database::search("SELECT * FROM `user` WHERE email='" . $product_data["user_email"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        ?>


                                        <span><i class="bi bi-geo-alt"></i>&nbsp;&nbsp;<?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>

                                            <!--Modal-->

                                            <!-- Your existing HTML code for the modal here -->
                                            <div class="modal" tabindex="" id="verificationModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content p-2">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Quick Chat</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12 scrollable-content" id="chat-content" style="height: 60vh;">
                                                                <!-- Chat messages will be inserted here -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-11">
                                                                        <input type="text" class="form-control" placeholder="Type here..." id="msg" />
                                                                    </div>
                                                                    <div class="col-1 d-flex justify-content-center align-items-center">
                                                                        <i class="bi bi-send-fill fs-3 text-primary" style="cursor: pointer;" onclick="send_msg(`<?php echo $product_data['user_email']; ?>`)"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Modal-->

                                    </div>

                                </div>
                                <?php
                                if ($_SESSION["u"]["email"] != $product_data["user_email"]) {
                                ?>
                                    <div style="position: absolute; height: 40px; width: 40px; border-radius: 20px; margin-top: 450px; margin-left: 1270px;" class="chat-icon" onclick="viewMessageModal(); viewMessage(`<?php echo $product_data['user_email']; ?>`);">
                                    <?php
                                }
                                    ?>
                                <?php
                            }
                                ?>

                                    </div>


                        </div>


                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>


            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Something went wrong");
}

?>