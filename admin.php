<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="icon" href="resources/logo.png" />
</head>

<body class="admin-body">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 mt-5">
                <div class="row text-center mt-5 offset-lg-2">
                    <div class="col-12">
                        <span class="mt-5 hello-admin">Hello Admin</span>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-6 mt-5">
                                <label class="text-white fs-4">Entery Your Email</label>
                                <br>
                                <input type="text" class="mt-4 w-75 ps-4 pb-1 admin-email-input" id="e">
                                <br><br><br>
                                <button class="btn btn-primary w-50" onclick="adminVerification();">Get Started</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!--Modal-->

             <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

             <!--Modal-->


        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>