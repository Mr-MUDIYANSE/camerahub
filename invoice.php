<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Onliner</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.png">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "headerInvoice.php";

            session_start();

            require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

            ?>
                <div class="col-12 mb-3 bg-light pt-3 pb-2">
                    <div class="row justify-content-center">

                        <div class="col-12 col-lg-8 bg-white border" id="page">

                            <div class="row">

                                <div class="col-12 col-lg-0 mt-2 invoicebg"></div>

                                <div class="col-6 col-lg-8 ps-lg-5 mt-2">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <h1>Onliner (PVT) Ltd.
                                                    <hr>
                                                </h1>
                                                <span><i class="bi bi-geo-alt"></i>&nbsp;&nbsp;&nbsp;Colombo 07, Sri Lanka</span><br>
                                                <span><i class="bi bi-envelope"></i>&nbsp;&nbsp;&nbsp;info@newtech.com</span><br>
                                                <span><i class="bi bi-telephone"></i>&nbsp;&nbsp;&nbsp;+94112 219834</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 mt-3">
                                    <div class="row">
                                        <div class="col-12 ms-5">
                                            <div class="row ms-2 invoice-logo"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="mt-1" />
                            <?php

                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                            $address_data = $address_rs->fetch_assoc();

                            ?>

                            <?php

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                            $invoice_data = $invoice_rs->fetch_assoc();

                            ?>

                            <div class="col-12 text-end">
                                <div class="row ps-lg-5">
                                    <span class="fs-3 fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span><br><br>
                                    <span><?php echo $address_data["line1"]; ?></span>
                                    <span><?php echo $address_data["line2"]; ?></span>
                                    <span><?php echo $umail; ?>.</span>
                                    <span><?php echo $_SESSION["u"]["mobile"]; ?></span><br>
                                    <span>INVOICE : <?php echo $invoice_data["id"]; ?></span>
                                    <span><?php echo $invoice_data["date"]; ?></span>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <table class="table">

                                    <thead>
                                        <tr class="border border-1 border-secondary">
                                            <th>Id</th>
                                            <th>Order No</th>
                                            <th>Product</th>
                                            <th class="text-end">Unit Price</th>
                                            <th class="text-end">Quantity</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr style="height: 72px;">
                                            <td class="fs-3"><?php echo $invoice_data["id"]; ?></td>
                                            <td> <span class="fw-bold text-primary p-2"><?php echo $oid; ?></span><br /></td>
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$invoice_data["product_id"]."'");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <td><span class="fw-bold fs-5 p-2"><?php echo $product_data["title"]; ?></span></td>
                                            <td class="fw-bold fs-6 text-end pt-4">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                            <td class="fw-bold fs-6 text-end pt-4"><?php echo $invoice_data["qty"]; ?></td>
                                            <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                                        </tr>
                                    </tbody>

                                    <tfoot>
                                    <?php
                                    
                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
                                    $city_data = $city_rs->fetch_assoc();
                                    
                                    $delivery = 350;

                                    $tot = $invoice_data["total"];
                                    $grand = $tot + $delivery;

                                    ?>
                                        <tr>
                                            <td colspan="4" class="border-0"></td>
                                            <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                            <td class="text-end">Rs. <?php echo $tot; ?> .00</td>
                                        </tr>>
                                        <tr>
                                            <td colspan="4" class="border-0"></td>
                                            <td class="fs-5 text-end fw-bold">Delivery Fee</td>
                                            <td class="text-end">Rs. <?php echo $delivery; ?>.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="border-0"></td>
                                            <td class="fs-5 text-end fw-bold border-primary text-primary">INVOICE TOTAL</td>
                                            <td class="text-end border-primary text-primary">Rs. <?php echo $grand; ?> .00</td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>

                            <div class="col-12 text-center">
                                <span class="fs-1 fw-bold text-primary">Thank You !</span>
                                <br>
                                <hr>

                                <label class="form-label fs-5 text-black-50 fw-bold">
                                    Invoice was created on a computer and it valid without a signature and Seal.
                                </label><br>
                                <label>&copy; Onliner.lk 2022-2022</label>
                            </div>


                        </div>

                        <div class="col-8 btn-toolbar mb-2 mt-3 justify-content-end">
                            <button class="btn btn-danger me-2"><i class="bi bi-download me-2"></i>Save as PDF</button>
                            <button class="btn btn-secondary" onclick="printInvoice();"><i class="bi bi-printer-fill me-2"></i></i>Print</button>
                        </div>


                    </div>
                </div>
            <?php

            } else {
                header("location:index.php");
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>