<?php

session_start();

require "connection.php";

$user = $_SESSION["u"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];

// echo($search);
// echo($time);
// echo($qty);

$query = "SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetimee_added` DESC";
    } elseif ($time == "2") {
        $query .= " ORDER BY `datetimee_added` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } elseif ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} elseif ($time == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } elseif ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}


?>

<div class="row justify-content-center mt-2 p-2">

<?php


if ("0" != ($_POST["page"])) {
    $pageno  = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 4;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query. " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;

for ($x = 0; $x <  $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();

?>


        <!-- card -->
        <div class="card mb-3 col-12 col-lg-6 gap-3">
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