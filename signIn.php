
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Onliner </title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="semantic.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resources/logo.png" />

</head>

<body class="main-body">

    <?php

    include "header.php";

    ?>

    <div class="container-fluid d-flex justify-content-center">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row mb-4 fs-1  text-center">
                    <label>Welcome to , Onliner</label>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row justify-content-center">
                    <div class="ui buttons w-75">
                        <button class="ui button" onclick="changeView();">Sign In</button>
                        <div class="or"></div>
                        <button class="ui positive button" onclick="changeView();">Sign Up</button>
                    </div>
                </div>
            </div>

            <!-- login -->

            <div class="col-12 col-lg-8 offset-lg-2 mb-5 mt-4" id="login">
                <div class="row">
                    <?php

                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                    ?>
                    <div class="col-12 col-lg-8">
                        <div class="row p-lg-1 border border-1">
                            <label class="form-label"><i class="mail icon"></i> Email</label>
                            <div class="col-12 ui input mb-4">
                                <input type="email" placeholder="Enter your Email" class="text-primary" value="<?php echo $email; ?>" id="email2" />
                            </div>
                            <label class="form-label mt-1"><i class="key icon"></i> Password</label>
                            <div class="col-12 ui input">
                                <input type="password" placeholder="Enter your Email" value="<?php echo $password; ?>" id="password" />
                            </div>
                            <div class="col-6 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" style="cursor: pointer;" id="rememberme" />
                                    <label class="form-check-label" for="flexCheckDefault" style="cursor: pointer;">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-end mt-1">
                                <a class="fs-6 text-primary" style="text-decoration: none; cursor: pointer;" onclick="forgotPassword();">Forgot Password ?</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="row text-center g-3">
                            <div class="col-12 mt-4">
                                <button class="ui inverted green button w-100  fw-bold" onclick="signIn();">Login</button>

                                <label class="form-label mt-2">or, login with</label>

                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger w-100 fw-bold">Google +</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100  fw-bold">Facebook</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- login -->

            <!-- modal vcode-->
            <div class="modal fade" id="forgotPasswordModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Verification Code</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter your Verification Code here</label>
                            <input type="text" class="form-control" id="verificationcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verifyCode();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->


            <!-- modal pw-->
            <div class="modal fade" id="resetPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Reset Password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Type your New Password</label>
                            <input type="text" class="form-control" id="rpw1">
                            <label class="form-label">Confirm your Password</label>
                            <input type="text" class="form-control" id="rpw2">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveResetPassword();">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

            <!-- Register -->
            <div class="col-12 d-none" id="signUp">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-6 mb-2">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="f">
                                    </div>

                                    <div class="col-6 mb-2">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="l">
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label>Email</label>
                                        <input type="emal" class="form-control" id="e">
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" id="m">
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="p">
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" id="cp">
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="mb-3">Gender</label>
                                        <select class="form-select" aria-label="Default select example" id="g">
                                            <option selected>Select your Gender</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `gender`");
                                            $n = $rs->num_rows;
                                            for ($x; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 text-center mb-3 mt-2">
                                        <button class="ui inverted primary button w-75" onclick="signUp();">Sign Up</button>
                                    </div>


                                    <div class="col-12 text-center mb-3">
                                        <button class="ui circular facebook icon button">
                                            <i class="facebook icon"></i>
                                        </button>
                                        <button class="ui circular twitter icon button">
                                            <i class="twitter icon"></i>
                                        </button>
                                        <button class="ui circular linkedin icon button">
                                            <i class="linkedin icon"></i>
                                        </button>
                                        <button class="ui circular google plus icon button">
                                            <i class="google plus icon"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Register -->
            </div>
        </div>
    </div>

    <?php

    include "footer1.php";

    ?>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</body>

</html>