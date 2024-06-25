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
    <link rel="icon" href="resources/favicon.ico" />
</head>

<body>


    <?php
    require "connection.php";
    session_start();
    ?>


    <div class="col-12 d-none d-lg-block headerbg fixed-top">
        <div class="row d-flex mt-3 bg-white">

            <div class="col-2 d-none d-lg-block">
                <a href="index.php">
                    <div class="logo"></div>
                </a>
            </div>

            <div class="col-7 d-flex justify-content-center align-items-center gap-5">
                <a href="index.php" style="cursor: pointer;" class="fw-semibold nav-links">HOME<i class="bi bi-caret-down ms-1"></i></a>
                <a href="shop.php" style="cursor: pointer;" class="fw-semibold nav-links">SHOP<i class="bi bi-caret-down ms-1"></i></a>
                <a href="#" style="cursor: pointer;" class="fw-semibold nav-links">PAGES<i class="bi bi-caret-down ms-1"></i></a>
                <a href="aboutUs.php" style="cursor: pointer;" class="fw-semibold nav-links">ABOUT US<i class="bi bi-caret-down ms-1"></i></a>
                <a href="contactUs.php" style="cursor: pointer;" class="fw-semibold nav-links">CONTACT US<i class="bi bi-caret-down ms-1"></i></a>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-between">
                <input type="text" placeholder="Search product..." class="search-input">
                <i class="bi bi-search fs-4" style="cursor: pointer;"></i>
                <?php
                if (isset($_SESSION["u"])) {

                    $email = $_SESSION["u"]["email"];

                    $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                        gender.id=user.gender_id WHERE `email`='" . $email . "'");

                    $user = $user_rs->fetch_assoc();

                    $mrs = Database::search("SELECT COUNT(`id`) FROM `chat` WHERE `to` = '" . $email . "' AND `status` = '0'");

                    $mr = $mrs->fetch_assoc();

                    $m = $mr["COUNT(`id`)"];

                ?>
                    <div class="position-relative">
                        <?php
                        if ($m > 0) {
                        ?>
                            <div style="position: absolute; margin-left: 12px; margin-top: -8px; height: 15px; width: 15px; border-radius: 7.5px; cursor: pointer;" class="bg-primary d-flex justify-content-center align-items-center p-2" onclick="chatWallModal(); loadChatWall(`<?php echo $email; ?>`);">
                                <span style="font-size: 10px; color: white; margin-top: 2px;"><?php echo $m; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                        <i class="bi bi-chat fs-4" style="cursor: pointer;" onclick="chatWallModal(); loadChatWall(`<?php echo $email; ?>`);"></i>
                    </div>
                    <i class="bi bi-people fs-4" style="cursor: pointer;" id="sidebar2"></i>


                <?php
                } else {
                ?>
                    <a href="signIn.php" class="text-decoration-none text-black fs-6">Sign In</a>
                <?php
                }
                ?>
                <a href="watchlist.php"><i class="bi bi-heart fs-4 text-black" style="cursor: pointer;"></i></a>
                <a href="cart.php" class="text-decoration-none"><i class="bi bi-bag fs-4 text-black" style="cursor: pointer;"></i></a>

            </div>

        </div>
        <hr>
    </div>

    <!--------------------------------------------------------------------->
    <div class="col-2 d-lg-none mt-2">

        <label id="sidebar2" class="item">
            <i class="sidebar icon fs-2"></i>
        </label>
        <div class="ui sidebar vertical left inverted menu">
            <a href="#" class="item">
                <?php

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                ?>

                    <span class="text-lg-start"><b>Welcome </b>&nbsp;&nbsp;<?php echo $data["fname"] . " " . $data["lname"];  ?></span>

                <?php


                } else {
                ?>

                    <a href="signIn.php" class="text-decoration-none fw-bold">Sign In | Register</a>

                <?php
                }

                ?>

            </a>
            <a href="">
                <hr class="bg-white border border-1">
            </a>
            <select class="ui dropdown text-white w-100 border-0 sidebarbgselect">
                <option class="bg-dark">Category</option>
                <?php

                $category_rs = Database::search("SELECT * FROM `category`");
                $category_num  = $category_rs->num_rows;

                for ($i = 0; $i < $category_num; $i++) {
                    $category_data = $category_rs->fetch_assoc();

                ?>
                    <option class="bg-dark" value="<?php echo $category_data['id'] ?>"><?php echo $category_data["name"] ?></option>
                <?php
                }


                ?>

            </select>

            <a href="cart.php" class="item"><i class="shopping cart icon"></i>Cart</a>
            <a href="watchlist.php" class="item"><i class="heart outline icon"></i>Watchlist</a>
            <a href="store.php" class="item"><i class="shopping bag icon"></i>My Store</a>
            <a href="sellerDashboard.php" class="item"><i class="dollar sign icon"></i>My Dashboard</a>
            <a href="purchasingHistory.php" class="item"><i class="history icon"></i>Purchasing History</a>
            <a href="">
                <hr class="bg-white border border-1">
            </a>
            <a href="profile.php" class="item"><i class="user outline icon"></i>Profile</a>
            <div style="margin-top: 200px;">
                <i style="margin-left: 210px; cursor: pointer;" class="bi bi-box-arrow-in-left text-white fs-2 text-end" onclick="signout();"></i>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------------------->

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="inmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3 d-block" id="exampleModalLabel1">Chat</h1>
                    <h1 class="modal-title fs-3 d-none" id="exampleModalLabel2"><i class="bi bi-arrow-left" onclick="backInbox();"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-0 p-0">

                    <!-- Wall -->
                    <div class="col-12 scrollable-content d-block" id="inbox-wall-content" style="height: 60vh;">
                        <!-- Chat wall will be inserted here -->

                    </div>

                    <!-- Inbox -->
                    <div class="col-12 t d-none inbox-content" id="inbox-content" style="height: 60vh; overflow-y: scroll;">
                        <!-- Chat messages will be inserted here -->
                    </div>

                </div>
                <div class="modal-footer d-none" id="modal-footer">
                    <div class="col-12">
                        <div class="row px-3 py-2">
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
    <!-- Modal end -->

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        $('#sidebar2').click(function() {
            $('.ui.sidebar').sidebar('toggle');
        });
    </script>
    <!-- <script src="bootstrap.js"></script> -->
</body>

</html>