<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchased History</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.png" />
</head>

<body>

    <?php
    include("header.php");
    ?>
    <div class="container-fluid">
        <div class="row">

            <div class="container" style="margin-top: 100px;">
                <div class="col-12">
                    <div class="row text-center justify-content-center">
                        <p style="font-family: 'Times New Roman', Times, serif; font-size: 40px;" class="mb-0">Purchasing History</p>
                        <div style="width: 100px;" class="line mt-1"></div>
                    </div>
                </div>
            </div>

            <?php


            if (isset($_SESSION["u"])) {
                $mail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT `user`.`fname` AS `fname`,`user`.`lname` AS `lname`,`invoice`.`in_id` AS `in_id`,`invoice`.`date` AS `date`,`invoice`.`total` AS `total`,`invoice`.`status` AS `status`,`invoice`.`product_id` AS `product_id`,`invoice`.`qty` AS `qty` FROM `invoice` INNER JOIN `product` ON product.id=invoice.product_id INNER JOIN `user` ON user.email=product.user_email WHERE `invoice`.`user_email`='" . $mail . "' ORDER BY `invoice`.`date` DESC");
                $invoice_num = $invoice_rs->num_rows;
            ?>

                <div class="col-12 mt-3">

                    <?php
                    if ($invoice_num == 0) {

                    ?>
                        <div class="col-12 text-center bg-body" style="height: 450px;">
                            <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                                You have not purchased any item yet...
                            </span>
                            <a href="index.php" class="btn btn-success mt-5 w-50">Shop Now</a>
                        </div>
                    <?php

                    } else {
                    ?>


                        <div class="col-12">
                            <div class="row justify-content-center mt-5">

                                <!-- table headres start -->


                                <div class="col-11">
                                    <div class="row">
                                        <table class="table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" scope="col">Product</th>
                                                    <th class="text-center" scope="col">Buyer</th>
                                                    <th class="text-center" scope="col">Ordered Date</th>
                                                    <th class="text-center" scope="col">Invoive No</th>
                                                    <th class="text-center" scope="col">Quantity</th>
                                                    <th class="text-center" scope="col">Unit price</th>
                                                    <th class="text-center" scope="col">Total</th>
                                                    <th class="text-center" scope="col">status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                for ($x = 0; $x < $invoice_num; $x++) {
                                                    $invoice_data = $invoice_rs->fetch_assoc();

                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $invoice_data["product_id"] . "'");
                                                    $product_data = $product_rs->fetch_assoc();

                                                    $total = $invoice_data["qty"] * $invoice_data["total"];

                                                ?>
                                                    <!-- table details start -->
                                                    <tr>
                                                        <th scope="row"><?php echo $product_data["title"]; ?></th>
                                                        <td class="text-center"><?php echo $invoice_data["fname"] . " " . $invoice_data["lname"]; ?></td>
                                                        <td class="text-center"><?php echo $invoice_data["date"]; ?></td>
                                                        <td class="text-center"><?php echo $invoice_data["in_id"]; ?></td>
                                                        <td class="text-center"><?php echo $invoice_data["qty"]; ?></td>
                                                        <td class="text-center"><?php echo $invoice_data["total"]; ?></td>
                                                        <td class="text-center"><?php echo $total; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($invoice_data["status"] == 0) {
                                                            ?>
                                                                <p class="text-end fw-bolder mt-1 mb-1">placed</p>
                                                            <?php
                                                            } else if ($invoice_data["status"] == 1) {
                                                            ?>
                                                                <p class="text-end text-success fw-bolder mt-1 mb-1">Confirmed</p>
                                                            <?php
                                                            } else if ($invoice_data["status"] == 2) {
                                                            ?>
                                                                <p class="text-end text-primary fw-bolder mt-1 mb-1">Packing</p>
                                                            <?php
                                                            } else if ($invoice_data["status"] == 3) {
                                                            ?>
                                                                <p class="text-end text-warning fw-bolder mt-1 mb-1">Shipping</p>
                                                            <?php
                                                            }else if($invoice_data["status"] == 4){
                                                                ?>
                                                                <p class="text-end fw-bolder text-danger mt-1 mb-1">Delivered</p>
                                                                
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <!-- table details start -->

                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- table headres end -->



                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <?php include "footer.php"; ?>

        </div>

    <?php
            } else {
                header("location:signIn.php");
            }
    ?>
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