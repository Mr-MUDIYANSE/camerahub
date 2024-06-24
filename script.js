function changeView() {

    var login = document.getElementById("login");
    var signUp = document.getElementById("signUp");

    login.classList.toggle("d-none");
    signUp.classList.toggle("d-none");

}

function signUp() {

    var fname = document.getElementById("f");
    var lname = document.getElementById("l");
    var email = document.getElementById("e");
    var mobile = document.getElementById("m");
    var pw = document.getElementById("p");
    var confirm_password = document.getElementById("cp");
    var country = document.getElementById("cntry");
    var gender = document.getElementById("g");



    if (pw.value == confirm_password.value) {
        password = pw;

        var f = new FormData();
        f.append("f", fname.value);
        f.append("l", lname.value);
        f.append("e", email.value);
        f.append("m", mobile.value);
        f.append("p", password.value);
        f.append("c", country.value);
        f.append("g", gender.value);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    window.location.reload();
                } else {
                    alert(t);
                }
            }
        }

        r.open("POST", "signUpProcess.php", true);
        r.send(f);

    } else {
        alert("Password does not matched")

    }

}

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

function signout() {

    let text = "Aye you sure you want to sign out?";
    if (confirm(text) == true) {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    window.location.reload();
                } else {
                    alert(t);
                    alert("Something went wrong");
                }
            }

        };

        r.open("GET", "signoutProcess.php", true);
        r.send();
    }

}

var bm;

function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Verification code has send your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModel");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }

        }
    }


    r.open("POST", "verificationProcess.php?e=" + email.value, true);
    r.send();

}

var am;

function verifyCode() {

    var verificationcode = document.getElementById("verificationcode");
    var email = document.getElementById("email2");


    var f = new FormData();
    f.append("verificationcode", verificationcode.value);
    f.append("email", email.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                bm.hide();

                var m = document.getElementById("resetPassword");
                am = new bootstrap.Modal(m);
                am.show();
            } else {
                alert(t);
            }
        }
    };


    r.open("POST", "resetPassword.php", true);
    r.send(f);
}

function saveResetPassword() {

    var email = document.getElementById("email2");
    var newpw = document.getElementById("rpw1");
    var rpw = document.getElementById("rpw2");


    var f = new FormData();
    f.append("email", email.value);
    f.append("newpw", newpw.value);
    f.append("rpw", rpw.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                am.hide();
                alert("Password change Success !")
            } else {
                alert("Try Again !");
            }
        }
    };


    r.open("POST", "saveResetPassword.php", true);
    r.send(f);
}

function changeImage() {
    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function saveChanges() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var country = document.getElementById("cntry");
    var image = document.getElementById("profileimg");


    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("cntry", country.value);
    f.append("pc", pcode.value);

    if (image.files.length == 0) {

        var confirmation = confirm("Are you sure You donnt want to update profile Picture ?");

        if (confirmation) {
            alert("You have not selected any Image");
        }

    } else {
        f.append("image", image.files[0]);
    }


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);


}

function changeStatus(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "deactivated") {

                swal({
                    title: "Product Dectivated!",
                    icon: "warning",
                    button: "OK",
                });


            } else if (t == "activated") {

                swal({
                    title: "Product Activated!",
                    icon: "success",
                    button: "OK",
                });

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}

function changeDeal(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "deactivated") {

                alert("Stoped Deal");
                window.location.reload();

            } else if (t == "activated") {

                alert("Deal Activated");
                window.location.reload();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "changeDealProcess.php?p=" + product_id, true);
    r.send();

}

function changeProductImage() {
    var image = document.getElementById("imguploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }

        } else {
            alert("Please select 3 or less than 3 images");
        }
    }
}

function publishedProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("modal");
    var title = document.getElementById("title");
    var colour = document.getElementById("color");
    var colour_input = document.getElementById("color_add");
    var qty = document.getElementById("qty");
    var price = document.getElementById("price");
    var description = document.getElementById("description");
    var image = document.getElementById("imguploader");

    var f = new FormData();

    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("col", colour.value);
    f.append("col_in", colour_input.value);
    f.append("qty", qty.value);
    f.append("cost", price.value);
    f.append("desc", description.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);

    }


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product saved successfully") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}



function sendId(id) {

    // alert(id);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                $('.ui.basic.modal')
                    .modal('show');
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendProductIdProcess.php?id=" + id, true);
    r.send();
}

function updateProduct() {

    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var price = document.getElementById("price");
    var description = document.getElementById("description");
    var images = document.getElementById("imguploader");

    // alert(title.value);
    // alert(qty.value);
    // alert(price.value);
    // alert(description.value);
    // alert(images.value);

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("p", price.value);
    f.append("d", description.value);

    var img_count = images.files.length;

    for (var x = 0; x < img_count; x++) {
        f.append("i" + x, images.files[x]);

    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Product Updated")
                window.location.reload();
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "updateProcess.php", true);
    r.send(f);
}

function reload() {
    window.location.reload();

}

// function sortProduct() {
//     $('.ui.modal')
//         .modal('show');
// }

function sort(p) {

    var search = document.getElementById("search");

    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    // alert(search.value);
    // alert(time);
    // alert(qty);

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("page", p);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;


            document.getElementById("sort").innerHTML = t;
        }
    };

    r.open("POST", "sortProccess.php", true);
    r.send(f);
}

function loadMainImg(id) {

    var img = document.getElementById("productImg" + id).src;
    var main = document.getElementById("main_img");
    main.style.backgroundImage = "url(" + img + ")";
}

function addToCart(id) {

    // alert(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function checkValue(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity mus be 1 or more");
        input.value = 1
    } else if (input.value > qty) {
        alert("Stock quantity exieted");
        input.value = qty;
    }
}

function addToWatchlist(id) {

    // alert(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                alert("Removed Product From Watchlist");
            } else if (t == "added") {
                alert("Added Product to Watchlist");
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {

    // alert(id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    r.send();
}

function removeFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Removed From Cart");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();

}

function payNow(id) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            var obj = JSON.parse(t);

            console.log(obj["qty"]);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (t == 1) {
                alert("Please login.");
                window.location = "signIn.php";
            } else if (t == 2) {
                alert("Please Update your profile");
                window.location = "Profile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);

                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221117", // Replace your Merchant ID
                    "return_url": "http://localhost/camerahub/singleProductView.php?id=" + id, // Important
                    "cancel_url": "http://localhost/camerahub/singleProductView.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city_name"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": "",
                    "hash": obj["hash"]
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                // };
            }
        }
    }

    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {

                window.location = "invoice.php?id=" + orderId;

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function printInvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

var av;

function adminVerification() {
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verificationProcessadmin.php?v=" + verification.value, true);
    r.send();
}

// admin pannle start

const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
})





if (window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
    if (this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
})

// admin pannle end

function blockProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "blockProduct.php?id=" + id, true);
    r.send();

}

function unblockProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "unblockProduct.php?id=" + id, true);
    r.send();

}

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "blockUser.php?email=" + email, true);
    r.send();

}

function unblockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "unblockUser.php?email=" + email, true);
    r.send();

}

function adsignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "admin.php";
            } else {
                alert(t);
            }
        }

    };

    r.open("GET", "adminsignoutProcess.php", true);
    r.send();
}

function changeOrderStatus(sId, inoviceId) {

    let statusId;

    if (sId == 0) {
        statusId = 1;
    } else if (sId == 1) {
        statusId = 2;
    } else if (sId == 2) {
        statusId = 3;
    } else if (sId == 3) {
        statusId = 4;
    }

    var f = new FormData();
    f.append("statusId", statusId);
    f.append("inoviceId", inoviceId);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "invoiceStatusChange.php", true);
    r.send(f);

}

function contact() {

    var name = document.getElementById("name");
    var phone = document.getElementById("phone");
    var subject = document.getElementById("subject");
    var msg = document.getElementById("msg");

    var f = new FormData();
    f.append("name", name.value);
    f.append("phone", phone.value);
    f.append("subject", subject.value);
    f.append("msg", msg.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Your message has been sended. Thank You !");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "contactUsProcess.php", true);
    r.send(f);

}
var x;
function viewMessageModal() {
    var adminVerificationModal = document.getElementById("verificationModal");
    x = new bootstrap.Modal(adminVerificationModal);
    x.show();
}

function viewMessage(rec_email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat-content").innerHTML = t;
        }
    };

    r.open("GET", "viewMsgProcess.php?rec-email=" + rec_email, true);
    r.send();
}


function send_msg(rec_email) {

    var rec_email = rec_email;
    var msg = document.getElementById("msg");

    var f = new FormData();
    f.append("rec_email", rec_email);
    f.append("msg", msg.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                document.getElementById("chat-content").innerHTML = viewMessage(rec_email);
                document.getElementById("msg").value = "";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}
