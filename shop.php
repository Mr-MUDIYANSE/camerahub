<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body>

    <?php
    include "header.php";
    ?>

    <div class="container" style="margin-top: 100px;">
        <div class="col-12">
            <div class="row text-center justify-content-center">
                <p style="font-family: 'Times New Roman', Times, serif; font-size: 40px;" class="mb-0">Shop</p>
                <div style="width: 40px;" class="line mt-1"></div>
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
            <div class="row mt-3 justify-content-lg-between">
                <!--------------------------------------------------------------->

                <?php

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c_data["id"] . "' AND `status_id`='1'");
                    $product_num = $product_rs->num_rows;

                    for ($z = 0; $z < $product_num; $z++) {
                        $product_data = $product_rs->fetch_assoc();

                ?>
                    <div class="card homecategorcard mb-5" style="width: 18rem; cursor: pointer;">
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