<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
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

            ?>

                <div class="container mb-5" style="margin-top: 90px;">
                    <div class="col-12">
                        <div class="row text-center justify-content-center">
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 40px;" class="mb-0">Dashboard</p>
                            <div style="width: 60px;" class="line mt-1"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12">

                    <div class="row p-lg-5 pt-lg-0 g-3">

                        <?php

                        $today = date("Y-m-d");
                        $thismonth = date("m");
                        $thisyear = date("Y");
                        $tday = date("d");

                        $a = "0";
                        $b = "0";
                        $e = "0";
                        $f = "0";
                        $c = "0";
                        $t = "0";
                        $y = "0";


                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE user_email = '" . $email . "'");
                        $invoice_num = $invoice_rs->num_rows;

                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();

                            $f = $f + $invoice_data["qty"]; //total qty

                            $d = $invoice_data["date"];
                            $splitDate = explode(" ", $d); //separate date from time
                            $pdate = $splitDate[0]; //sold date

                            if ($pdate == $today) {
                                $a = $a + $invoice_data["total"];
                                $c = $c + $invoice_data["qty"];
                            }

                            $splitMonth = explode("-", $pdate); //separate date as year,month & date
                            $pyear = $splitMonth[0]; //year
                            $pmonth = $splitMonth[1]; //month
                            $pdate = $splitMonth[2]; //date

                            if ($pyear == $thisyear) {
                                $y = $y + $invoice_data["total"];
                                if ($pmonth == $thismonth) {
                                    $b = $b + $invoice_data["total"];
                                    $e = $e + $invoice_data["qty"];
                                }
                            }
                            $t = $t + $invoice_data["total"];
                        }

                        ?>

                        <div class="col-12">
                            <div class="row text-center d-flex justify-content-center gap-3">
                                <div class="col-12 col-lg-2 tile-bg">
                                    <p class="text-white fw-bold mt-1">Today Earnings</p>
                                    <p class="mt-4 fw-bold fs-3" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rs <?php echo $a; ?>.00</p>
                                </div>
                                <div class="col-12 col-lg-2 tile-bg">
                                    <p class="text-white fw-bold mt-1">Monthly Earnings</p>
                                    <p class="mt-4 fw-bold fs-3" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rs <?php echo $b; ?>.00</p>
                                </div>
                                <div class="col-12 col-lg-2 tile-bg">
                                    <p class="text-white fw-bold mt-1">Yearly Earnings</p>
                                    <p class="mt-4 fw-bold fs-3" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rs <?php echo $y; ?>.00</p>
                                </div>
                                <div class="col-12 col-lg-2 tile-bg">
                                    <p class="text-white fw-bold mt-1">Total Earnings</p>
                                    <p class="mt-4 fw-bold fs-3" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rs <?php echo $t; ?>.00</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 p-lg-3">
                            <div class="row border pt-lg-3 ps-lg-2 pe-lg-2 bg-white text-center">
                                <label class="fw-bold fs-4 mb-3">Order History</label>
                                <div class="col-12">

                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Invoice ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Buyer</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $query = "SELECT * FROM `invoice` WHERE `user_email` = '" . $email . "' ORDER BY `date` DESC";
                                            $pageno;

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            $invoice_rs = Database::search($query);
                                            $invoice_num = $invoice_rs->num_rows;

                                            $results_per_page = 100;
                                            $number_of_pages = ceil($invoice_num / $results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;
                                            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                            $selected_num = $selected_rs->num_rows;

                                            for ($x = 0; $x < $selected_num; $x++) {
                                                $selected_data = $selected_rs->fetch_assoc();

                                            ?>

                                                <tr>
                                                    <th scope="row"><?php echo $selected_data["in_id"]; ?></th>
                                                    <?php
                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                                    $product_data = $product_rs->fetch_assoc();
                                                    ?>
                                                    <td><?php echo $product_data["title"]; ?></td>
                                                    <?php
                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                                    $user_data = $user_rs->fetch_assoc();
                                                    ?>
                                                    <td><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
                                                    <td><?php echo $selected_data["date"]; ?></td>
                                                    <td><?php echo $selected_data["total"]; ?></td>
                                                    <td><?php echo $selected_data["qty"]; ?></td>
                                                    <td>
                                                        <?php
                                                            if ($selected_data["status"] == 0) {
                                                            ?>
                                                                <p class="text-end btn btn-secondary fw-bolder mt-1 mb-1" onclick='changeOrderStatus(0,<?php echo $selected_data["in_id"]; ?>);'>placed</p>
                                                            <?php
                                                            } else if ($selected_data["status"] == 1) {
                                                            ?>
                                                                <p class="text-end btn btn-success fw-bolder mt-1 mb-1" onclick='changeOrderStatus(1,<?php echo $selected_data["in_id"]; ?>);'>Confirmed</p>
                                                            <?php
                                                            } else if ($selected_data["status"] == 2) {
                                                            ?>
                                                                <p class="text-end btn btn-primary fw-bolder mt-1 mb-1" onclick='changeOrderStatus(2,<?php echo $selected_data["in_id"]; ?>);'>Packing</p>
                                                            <?php
                                                            } else if ($selected_data["status"] == 3) {
                                                            ?>
                                                                <p class="text-end btn btn-warning fw-bolder mt-1 mb-1" onclick='changeOrderStatus(3,<?php echo $selected_data["in_id"]; ?>);'>Shipping</p>
                                                            <?php
                                                            }else if($selected_data["status"] == 4){
                                                                ?>
                                                                <p class="text-end fw-bolder btn btn-danger mt-1 mb-1">Delivered</p>
                                                                
                                                                <?php
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>

                                            <?php

                                            }

                                            ?>
                                        </tbody>
                                    </table>

                                    <div class="col-12 mt-2" id="viewArea">

                                        <!--  -->
                                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-3">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-lg justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <?php

                                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                                        if ($x == $pageno) {
                                                    ?>
                                                            <li class="page-item active">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>
                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                    <li class="page-item">
                                                        <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <!--  -->
                                    </div>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php

            } else {
                header("location:signIn.php");
            }


            ?>

        </div>
    </div>

    <?php
    include "footer.php";
    ?>

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