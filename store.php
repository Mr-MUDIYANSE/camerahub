<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop | Onliner</title>
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

            <?php include "header.php";

            ?>

            <div class="col-12" style="margin-top: 50px;">
                <div class="row">

                    <div class="col-12">

                        <div class="col-12 mb-5">
                            <div class="row text-center justify-content-center">
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px;" class="mt-5 mb-0">My Store</p>
                                <div style="width: 100px;" class="line mt-1"></div>
                            </div>
                        </div>
                        <!-- product -->
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-10">

                                    <div class="row h-100" id="sort">
                                        <div class="col-12">
                                            <div class="row justify-content-center mt-2 gap-4">

                                                <?php


                                                if (isset($_GET["page"])) {
                                                    $pageno  = $_GET["page"];
                                                } else {
                                                    $pageno = 1;
                                                }

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $email . "'");
                                                $product_num = $product_rs->num_rows;

                                                $results_per_page = 4;
                                                $number_of_pages = ceil($product_num / $results_per_page);

                                                $page_results = ($pageno - 1) * $results_per_page;
                                                $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $email . "'
                                                LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                                $selected_num = $selected_rs->num_rows;

                                                for ($x = 0; $x <  $selected_num; $x++) {
                                                    $selected_data = $selected_rs->fetch_assoc();

                                                ?>


                                                    <!-- card -->
                                                    <div class="card mb-3 col-12 col-lg-5">
                                                        <div class="row">
                                                            <div class="col-md-4 mt-3 mb-2">
                                                                <?php

                                                                $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                                $product_img_data = $product_img_rs->fetch_assoc();

                                                                ?>
                                                                <img src="<?php echo $product_img_data["name"] ?>" class="img-fluid rounded-start" style="height: 150px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">

                                                                    <h5 class="card-title fs-5"><?php echo $selected_data["title"]; ?></h5>
                                                                    <hr>

                                                                    <label class="form-label text-danger fw-bold me-4">RS <?php echo $selected_data["price"]; ?> .00</label>
                                                                    <label class="form-labe text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</label>

                                                                    <div class="form-check form-switch ">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) { ?>checked<?php } ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);" />
                                                                        <label class="form-check-label fw-bold text-primary" for="fd<?php echo $selected_data["id"]; ?>">
                                                                            <?php if ($selected_data["status_id"] == 2) { ?>
                                                                                Make Your Product Active
                                                                            <?php } else { ?>
                                                                                Make Your Product Deactive
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["deal_id"] == 2) { ?>checked<?php } ?> onclick="changeDeal(<?php echo $selected_data['id']; ?>);" />
                                                                        <label class="form-check-label fw-bold text-primary" for="fd<?php echo $selected_data["id"]; ?>">
                                                                            <?php if ($selected_data["deal_id"] == 2) { ?>
                                                                                Stop weekly deal
                                                                            <?php } else { ?>
                                                                                Show your product weekly deal
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </label>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="row mt-2">
                                                                                <div class="col-6 text-center">
                                                                                    <button href="updateProduct.php" class="btn btn-outline-primary w-75" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                                </div>
                                                                                <div class="col-6 text-center">
                                                                                    <button class="btn btn-outline-danger w-75">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- card -->

                                                <?php
                                                }
                                                ?>

                                                <!-- pagination -->

                                                <div class="col-8 text-center mb-3">

                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pagination-lg justify-content-center">
                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($pageno - 1);
                                                                                            } ?>" aria-label="Previous">
                                                                    <span aria-hidden="true">&laquo;</span>
                                                                </a>
                                                            </li>
                                                            <?php

                                                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                                                if ($x == $pageno) {

                                                            ?>
                                                                    <li class="page-item active">
                                                                        <a class="page-link" href="<?php echo "?page=" . $x; ?>"><?php echo $x; ?></a>
                                                                    </li>
                                                                <?php

                                                                } else {

                                                                ?>
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="<?php echo "?page=" . $x; ?>"><?php echo $x; ?></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($pageno + 1);
                                                                                            } ?>" aria-label="Next">
                                                                    <span aria-hidden="true">&raquo;</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>

                                                <!-- pagination -->

                                            </div>
                                        </div>
                                    </div>
                                    <!-- product -->

                                </div>

                                <div class="col-12 col-lg-2">

                                    <div class="row">

                                        <div class="col-12 text-center">
                                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px;" class="fw-bold fs-4">Sort Product</p>
                                            <hr />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3 mb-2">
                                            <label class="form-check-label fw-bold">By quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="n">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="o">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-4 mb-3 ">
                                            <div class="row g-2">
                                                <div class="col-12 d-grid mb-1">
                                                    <button class="btn btn-warning fw-bold w-100" onclick="sort(0);">Sort</button>
                                                </div>
                                                <div class="col-12 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear Sort</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-4 mb-3 ">
                                            <div class="row g-2">
                                                <div class="col-12 d-grid mb-1">
                                                    <a href="addProduct.php" class="btn btn-success fw-bold w-100 mt-4">Add New Product</a>
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
                if (isset($_SESSION["product"])) {

                ?>
                    <!-- update modal start -->
                    <div class="col-12">
                        <div class="row">
                            <div class="ui basic modal">
                                <div class="ui icon header">
                                    <label class="form-label text-warning fw-bolder fs-1 offset-lg-6">Product Update</label>
                                </div>
                                <div class="content">
                                    <div class="col-12 ">
                                        <div class="row offset-lg-6">

                                            <?php
                                            $product = $_SESSION["product"];

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $product["id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            ?>

                                            <div class="col-12 mb-2">
                                                <div class="row">
                                                    <label class="fs-3 text-white fw-bold">Title</label>
                                                    <input type="text" class="form-control fw-bold" value="<?php echo $product_data["title"]; ?>" id="title">
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 mb-2">
                                                <div class="row">
                                                    <label class="fs-3 text-white fw-bold">Quantity</label>
                                                    <input type="number" class="form-control" value="<?php echo $product_data["qty"]; ?>" min="0" id="qty" />
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 mb-2">
                                                <div class="row">
                                                    <label class="fs-3 text-white fw-bold">Price</label>
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="price" value="<?php echo $product_data["price"]; ?>" />
                                                        <span class="input-group-text ">.00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-2">
                                                <div class="row">
                                                    <label class="fs-3 text-white fw-bold">Description</label>
                                                    <textarea class="form-control" cols="30" rows="8" id="description"><?php echo $product_data["description"]; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-2 mt-2">
                                                <label for="imguploader">
                                                    <?php

                                                    $img = array();
                                                    $img[0] = "resources/addproductimg.svg";
                                                    $img[1] = "resources/addproductimg.svg";
                                                    $img[2] = "resources/addproductimg.svg";

                                                    $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                                    $images_num = $images_rs->num_rows;

                                                    for ($x = 0; $x < $images_num; $x++) {
                                                        $images_data = $images_rs->fetch_assoc();
                                                        $img[$x] = $images_data["name"];
                                                    }

                                                    ?>
                                                    <div class="row">
                                                        <label class="fs-3 text-white fw-bold">Product Images</label>
                                                        <div class="col-4 border border-primary rounded text-center bg-white">
                                                            <img src="<?php echo $img[0]; ?>" class="img-fluid" style="height: 100px; cursor: pointer;" id="i0" />
                                                        </div>
                                                        <div class="col-4 border border-primary rounded text-center bg-white">
                                                            <img src="<?php echo $img[1]; ?>" class="img-fluid" style="height: 100px; cursor: pointer;" id="i1" />
                                                        </div>
                                                        <div class="col-4 border border-primary rounded text-center bg-white">
                                                            <img src="<?php echo $img[2]; ?>" class="img-fluid" style="height: 100px; cursor: pointer;" id="i2" />
                                                        </div>
                                                        <input type="file" class="d-none" id="imguploader" onclick="changeProductImage();" multiple />
                                                    </div>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="actions">
                                    <div class="ui red  cancel inverted button" onclick="reload();">
                                        <i class="remove icon"></i>
                                        Cancel
                                    </div>
                                    <div class="ui green ok inverted button" onclick="updateProduct();">
                                        <i class="checkmark icon"></i>
                                        Update
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    // echo ("No product");
                }
                ?>
                <!-- update modal end -->



                <!-- sort start -->
                <div class="ui modal">
                    <i class="close icon"></i>
                    <div class="header">
                        Profile Picture
                    </div>
                    <div class="image content">
                        <div class="ui medium image">
                            <img src="/images/avatar/large/chris.jpg">
                        </div>
                        <div class="description">
                            <div class="ui header">We've auto-chosen a profile image for you.</div>
                            <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
                            <p>Is it okay to use this photo?</p>
                        </div>
                    </div>
                    <div class="actions">
                        <div class="ui black deny button">
                            Nope
                        </div>
                        <div class="ui positive right labeled icon button">
                            Yep, that's me
                            <i class="checkmark icon"></i>
                        </div>
                    </div>
                </div>
                <!-- sort end -->

            </div>
            <?php include "footer.php" ?>
        </div>



        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>