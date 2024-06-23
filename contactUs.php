<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resources/favicon.ico" />
    <title>About Us</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: url('https://i.imgur.com/kk76J5I.jpg') no-repeat top center;
            background-size: cover;
            height: 100vh;
        }

        .wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 550px;
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .wrapper .title h1 {
            color: #c5ecfd;
            text-align: center;
            margin-bottom: 25px;
        }

        .contact-form {
            display: flex;
        }

        .input-fields {
            display: flex;
            flex-direction: column;
            margin-right: 4%;
        }

        .input-fields,
        .msg {
            width: 48%;
        }

        .input-fields .input,
        .msg textarea {
            margin: 10px 0;
            background: transparent;
            border: 0px;
            border-bottom: 2px solid #c5ecfd;
            padding: 10px;
            color: #c5ecfd;
            width: 100%;
        }

        .msg textarea {
            height: 153px;
        }

        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #c5ecfd;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: #c5ecfd;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: #c5ecfd;
        }



        @media screen and (max-width: 600px) {
            .contact-form {
                flex-direction: column;
            }

            .msg textarea {
                height: 80px;
            }

            .input-fields,
            .msg {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <div class="container-fluid">
        <div class="col-12 pt-4">
            <div class="row mt-5">
                <div class="col-12 contact-img">
                    <div class="row h-100 opacity-bg">
                        <div class="col-12">

                            <div class="row">
                                <div class="col-8">
                                    <div class="wrapper mt-5">
                                        <div class="title line2">
                                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 40px;" class="text-white text-center mb-3">Contact Us</p>
                                        </div>
                                        <div class="contact-form">
                                            <div class="input-fields">
                                                <input type="text" id="name" class="input" placeholder="Name" required>
                                                <input type="text" id="phone" class="input" placeholder="Phone" required>
                                                <input type="text" id="subject" class="input" placeholder="Subject" required>
                                            </div>
                                            <div class="msg">
                                                <textarea placeholder="Message" id="msg"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row d-flex justify-content-center">
                                                <button class="btn btn-primary w-50 mt-3" onclick="contact();">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

    <script src="script.js"></script>
</body>

</html>