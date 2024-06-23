<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="semantic.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body>

    <div class="coontainer-fluid">
        <div class="row">

            <?php include "header.php"; ?>
            <div class="col-12 mt-3">

                <div class="col-12 mb-5 mt-5">
                    <div class="row text-center justify-content-center">
                        <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px;" class="mt-5 mb-0">Add New Product</p>
                        <div style="width: 100px;" class="line mt-1"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="row d-flex justify-content-center gap-4">
                            <div class="col-10">
                                <div class="row">

                                    <div class="col-12 col-lg-4">
                                        <label class="form-label fw-bold">Select Category</label>
                                        <select class="form-select text-center" id="category">
                                            <option value="0" class="fw-bold">Select Category</option>
                                            <?php

                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num =  $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Select Brand</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-center " id="brand">
                                                    <option value="0">Select Brand</option>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `brand`");
                                                    $brand_num =  $brand_rs->num_rows;

                                                    for ($y = 0; $y < $brand_num; $y++) {
                                                        $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Select Model</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-center " id="modal">
                                                    <option value="0">Select Modal</option>

                                                    <?php

                                                    $modal_rs = Database::search("SELECT * FROM `modal`");
                                                    $modal_num =  $modal_rs->num_rows;

                                                    for ($z = 0; $z < $modal_num; $z++) {
                                                        $modal_data = $modal_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $modal_data["id"]; ?>"><?php echo $modal_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row justify-content-center mt-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Product Title</label>
                                                <input type="text" class="form-control" id="title">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="row">

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Select Color</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">

                                                            <select class="form-select" id="color">
                                                                <option value="0">Select Color</option>

                                                                <?php


                                                                $color_rs = Database::search("SELECT * FROM `color`");
                                                                $color_num = $color_rs->num_rows;

                                                                for ($a = 0; $a < $color_num; $a++) {
                                                                    $color_data = $color_rs->fetch_assoc();

                                                                ?>

                                                                    <option value="<?php echo $color_data["id"] ?>"><?php echo $color_data["color_name"]; ?></option>

                                                                <?php
                                                                }


                                                                ?>

                                                            </select>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Add Product Quantity</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control" value="0" min="0" id="qty" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-12">
                                                                <label class="form-label fw-bold">Price Per Item</label>
                                                            </div>
                                                            <div class="col-12 ">
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text">Rs.</span>
                                                                    <input type="text" class="form-control" id="price" />
                                                                    <span class="input-group-text ">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" cols="30" rows="10" id="description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <label class="form-label fw-bold">Add Product Images</label>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="row gap-2 d-flex d-flex justify-content-between">
                                                <div class="col-3 border border-primary rounded text-center" style="width: 100px;">
                                                    <input type="file" class="d-none" id="imguploader" onclick="changeProductImage();" multiple />
                                                    <label for="imguploader"><img src="resources/addproductimg.png" class="img-fluid" style="height: 100px;" id="i0" /></label>
                                                </div>
                                                <div class="col-3 border border-primary rounded text-center" style="width: 100px;">
                                                    <input type="file" class="d-none" id="imguploader" onclick="changeProductImage();" multiple />
                                                    <label for="imguploader"><img src="resources/addproductimg.png" class="img-fluid" style="height: 100px;" id="i1" /></label>
                                                </div>
                                                <div class="col-3 border border-primary rounded text-center" style="width: 100px;">
                                                    <input type="file" class="d-none" id="imguploader" onclick="changeProductImage();" multiple />
                                                    <label for="imguploader"><img src="resources/addproductimg.png" class="img-fluid" style="height: 100px;" id="i2" /></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 mt-5 mb-3">
                                        <div class="row justify-content-center">
                                            <button class="btn w-50 fw-bold" style="background-color: #00cd27; color: white;" onclick="publishedProduct();">Add Product</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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
</body>

</html>