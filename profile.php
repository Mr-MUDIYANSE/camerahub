<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="semantic.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body>

    <div class="container-fluid">
        <?php include "header.php" ?>
        <div class="row">
            <div class="col-12">
                <div class="row">

                    <div class="col-12 mt-5">

                        <div class="col-12 mb-5">
                            <div class="row text-center justify-content-center">
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px;" class="mt-5 mb-0">My Profile</p>
                                <div style="width: 100px;" class="line mt-1"></div>
                            </div>
                        </div>

                        <?php

                        if (isset($_SESSION["u"])) {

                            $email = $_SESSION["u"]["email"];

                            $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                            gender.id=user.gender_id WHERE `email`='" . $email . "'");

                            $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                            user_has_address.city_id=city.id INNER JOIN `district` ON 
                            city.district_id=district.id INNER JOIN `province` ON 
                            district.province_id=province.id  WHERE `user_email`='" . $email . "'");

                            $user = $user_rs->fetch_assoc();
                            $address_data = $address_rs->fetch_assoc();

                            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                            $image_data = $image_rs->fetch_assoc();


                        ?>

                            <div class="row mt-3 ms-3">
                                <div class="col-12">
                                    <div class="row justify-content-center">
                                        <?php
                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resources/profile_img/new_user.png" class="rounded-circle bg-white" style="width: 140px" ; id="viewImg" />
                                        <?php
                                        } else {
                                        ?>
                                            <div style="width: 150px; height:150px;" class="d-flex justify-content-center pro-img-bg-main">
                                                <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle" style="width: 150px; height=130px; z-index: 0;" id="viewImg" />
                                                <div class="pro-img-bg">
                                                    <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                                    <label for="profileimg" onclick="changeImage();" style="z-index: 10; cursor: pointer; margin-top: 10px;"><i class="bi bi-pencil-fill fs-3 fw-bold" style="margin-left: 60px;"></i></label>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                        <div class="col-11">
                                            <div class="row g-3 mt-2 me-3 ">

                                                <div class="col-12 col-lg-6">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["fname"]; ?>" id="fname" />
                                                </div>

                                                <div class="col-12 col-lg-6">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["lname"]; ?>" id="lname" />
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Mobile</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["mobile"]; ?>" id="mobile" />
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Password</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["password"]; ?>" readonly />
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["email"]; ?>" readonly />
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Joined Date</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["joined_date"]; ?>" readonly>
                                                </div>
                                                <?php
                                                if (!empty($address_data["line1"])) {

                                                ?>

                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label">Address Line 01</label>
                                                        <input type="text" class="form-control" value="<?php echo $address_data["line1"]; ?>" id="line1" />
                                                    </div>

                                                <?php

                                                } else {
                                                ?>

                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label">Address line 01</label>
                                                        <input type="text" class="form-control" id="line1" />
                                                    </div>

                                                <?php
                                                }

                                                if (!empty($address_data["line2"])) {

                                                ?>

                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label">Address Line 02</label>
                                                        <input type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>" id="line2" />
                                                    </div>

                                                <?php

                                                } else {
                                                ?>

                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label">Address line 02</label>
                                                        <input type="text" class="form-control" id="line2" />
                                                    </div>

                                                <?php
                                                }

                                                $province_rs = Database::search("SELECT * FROM `province`");
                                                $district_rs = Database::search("SELECT * FROM `district`");
                                                $city_rs = Database::search("SELECT * FROM `city`");

                                                ?>

                                                <div class="col-12 col-lg-3">
                                                    <label class="form-label">Province</label><br>
                                                    <select class="ui search dropdown w-100 p-0 bg-body" id="province">
                                                        <option value="0">Select Province</option>
                                                        <?php
                                                        $province_num =  $province_rs->num_rows;
                                                        for ($x = 0; $x < $province_num; $x++) {
                                                            $province_data = $province_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $province_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {

                                                                                                                    if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }

                                                                                                                            ?>><?php echo $province_data["province_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-3">
                                                    <label class="form-label">District</label>
                                                    <select class="ui search dropdown w-100 p-0 bg-body" id="district">
                                                        <option value="">Select District</option>
                                                        <?php
                                                        $district_num =  $district_rs->num_rows;
                                                        for ($x = 0; $x < $district_num; $x++) {
                                                            $district_data = $district_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                                                                    if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>><?php echo $district_data["district_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-3">
                                                    <label class="form-label">City</label>
                                                    <select class="ui search dropdown w-100 p-0 bg-body" id="city">
                                                        <option>Select City</option>
                                                        <?php
                                                        $city_num =  $city_rs->num_rows;
                                                        for ($x = 0; $x < $city_num; $x++) {
                                                            $city_data = $city_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                                            if (!empty($address_data["city_id"])) {
                                                                                                                if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                    }
                                                                                                                }
                                                                                                                        ?>><?php echo $city_data["city_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>


                                                <?php

                                                if (!empty($address_data["postal_code"])) {
                                                ?>
                                                    <div class="col-12 col-lg-3">
                                                        <label class="form-label">Postal-Code</label>
                                                        <input type="text" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" id="pcode" />
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-12 col-lg-3">
                                                        <label class="form-label">Postal-Code</label>
                                                        <input type="text" class="form-control" id="pcode" />
                                                    </div>
                                                <?php
                                                }

                                                ?>



                                                <div class="col-12">
                                                    <label class="form-label">Gender</label>
                                                    <input type="text" class="form-control" value="<?php echo $user["gender_name"]; ?>" readonly />
                                                </div>


                                                <div class="col-12 text-center mb-3 mt-5">
                                                    <button class="btn w-25 fw-bold" style="background-color: #00cd27; color: white;" onclick="saveChanges();">Save Changes</button>
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


                        } else {
                            header("location:signIn.php");
                        }

        ?>
        <?php include "footer.php" ?>
        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</body>

</html>