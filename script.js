function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}

function signUp() {
    var f = document.getElementById("fname");
    var l = document.getElementById("lname");
    var e = document.getElementById("email");
    var p = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var form = new FormData();
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                f.value = "";
                l.value = "";
                e.value = "";
                p.value = "";
                m.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(form);
}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("rm", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }

        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(form);
}

var bm;

function forgotPassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                alert("Verification Code has send to your email. Please check inbox. ");
                var m = document.getElementById("fogotPasswordModel");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showpassword1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = "<i class='bi bi-eye-fill'></i>";
    } else {
        np.type = "password";
        npb.innerHTML = "<i class='bi bi-eye-slash-fill'>";
    }
}

function showpassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = "<i class='bi bi-eye-fill'></i>";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "<i class='bi bi-eye-slash-fill'>";
    }
}

function resetpassword() {

    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                alert("Password reset success.");
                bm.hide();

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}

function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (this.readyState == 4) {
            var t = this.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }

    };


    r.open("GET", "signOutProcess.php", true);
    r.send();
}

function adminVerification() {

    var e = document.getElementById("em");

    var form = new FormData();
    form.append("em", e.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                var verificationModal = document.getElementById("verificationModal");
                xm = new bootstrap.Modal(verificationModal);
                xm.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(form);

}

function verify() {

    var vcode = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                xm.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verifyProcess.php?id=" + vcode.value, true);
    r.send();
}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var img_count = image.files.length;

        for (var x = 0; x < img_count; x++) {

            var file = this.files[x];
            var url = window.URL.createObjectURL(file);

            document.getElementById("preview" + x).src = url;

        }
    }
}

function addproduct() {

    var category = document.getElementById("category");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("description");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("category", category.value);
    form.append("model", model.value);
    form.append("title", title.value);
    form.append("cost", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("description", description.value);

    var r = new XMLHttpRequest();

    var img_count = image.files.length;

    if (img_count != 3) {

        alert("Please add 3 product images");

    } else {

        for (var x = 0; x < img_count; x++) {

            form.append("img" + x, image.files[x]);

        }

        r.open("POST", "addproductprocess.php", true);
        r.send(form);

    }

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Product added successfully");
                window.location = "addproduct.php";
            } else {
                alert(t);
            }
        }
    }

}

function sortFunction() {

    var search = document.getElementById("s");

    var time;
    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function clearSort() {
    window.location = "myproducts.php";
}

function changeStatus(id) {
    var product_id = id;
    var switch_btn = document.getElementById("flexSwitchCheckDefault" + id);
    var switch_lbl = document.getElementById("switchlbl" + id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "deactivated") {

                alert("Product has been Deactivated");
                window.location = "myproducts.php";

            } else if (t == "activated") {
                alert("Product has been Activated");
                window.location = "myproducts.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "statusChangeProcess.php?id=" + product_id, true);
    r.send();
}

function changeImage() {

    var view = document.getElementById("viewimg"); //image tag
    var file = document.getElementById("profileimg"); //file chooser

    file.onchange = function () {

        var file1 = this.files[0];
        var url1 = window.URL.createObjectURL(file1);
        view.src = url1;

    }
}

function viewpw() {
    var pwtxt = document.getElementById("pwtxt");
    var pwbtn = document.getElementById("viewpassword");

    if (pwtxt.type == "text") {
        pwtxt.type = "password";
        pwbtn.innerHTML = "<i class='bi bi-eye-fill'></i>";
    } else {
        pwtxt.type = "text";
        pwbtn.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
    }
}

function update_profile() {

    var fname = document.getElementById("fn");
    var lname = document.getElementById("ln");
    var mobile = document.getElementById("mo"); 
    var line1 = document.getElementById("l1");
    var line2 = document.getElementById("l2");
    var province = document.getElementById("pr");
    var district = document.getElementById("dr");
    var city = document.getElementById("ci");
    var postal_code = document.getElementById("pc");
    var image = document.getElementById("profileimg");
    var pue = document.getElementById("profileUpdateError");

    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("m", mobile.value);
    form.append("li1", line1.value);
    form.append("li2", line2.value);
    form.append("pr", province.value);
    form.append("di", district.value);
    form.append("ci", city.value);
    form.append("pc", postal_code.value);

    if (image.files.length == 0) {

        var confirmAction = confirm("Are you sure you don't want to update your profile picture?");

        if (confirmAction) {
            alert("You have not selected any image");
        } else {
        }
    } else {
        form.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Log In to your account first.") {
                alert(t);
                window.location = "index.php";
            } else if (t == "success") {
                window.location = "userprofile.php";
            } else {
                pue.innerHTML = t;
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                window.location = "updateproduct.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "sendProductIdProcess.php?id=" + id, true);
    r.send();

}

function updateProduct() {

    var title = document.getElementById("ti");
    var cost = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("c", cost.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("d", description.value);

    var r = new XMLHttpRequest();

    var img_count = image.files.length;

    if (img_count != 3) {

        alert("Please add 3 product images");

    } else {

        for (var x = 0; x < img_count; x++) {

            f.append("i" + x, image.files[x]);

        }

        r.open("POST", "updateProcess.php", true);
        r.send(f);

    }

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            window.location = "myproducts.php";
        }
    }
}

var basicSearchCategory = 0;

function selectCategoty(x, y) {

    basicSearchCategory = y;

    var f = new FormData();
    f.append("page", x);
    f.append("catId", y);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "selectCategoryProcess.php?", true);
    r.send(f);

}

function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);
    f.append("cat", basicSearchCategory);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("basicSearchResult").innerHTML = t;

        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);

}

function advancedSearch(x) {
    var search = document.getElementById("t");
    var category = document.getElementById("c1");
    var model = document.getElementById("m1");
    var pricef = document.getElementById("pf");
    var pricet = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();
    f.append("t", search.value);
    f.append("c", category.value);
    f.append("m", model.value);
    f.append("pf", pricef.value);
    f.append("pt", pricet.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    };

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);
}

function loadMainImg(id) {

    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + sample_img + ")";

}

function check_value(qty) {

    var input = document.getElementById("qtyInput");

    if (input.value <= 0) {
        alert("Product quantity must be greater than 1.");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficient Quantity.");
        input.value = qty;
    }

}

function qty_inc(qty) {
    var input = document.getElementById("qtyInput");

    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();


}

function qty_dec() {

    var input = document.getElementById("qtyInput");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
    } else {
        alert("Minimum quantity has achieved.");
    }

}

function addToCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            }
        }
    }

    r.open("GET", "signoutprocess.php", true);
    r.send();

}

function cartCartQty(id) {

    var input = document.getElementById("cardCartQty"+id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

            if (t == "Product QTY updated") {
                window.location = "cart.php";
            }

        }
    }

    if (input.value < 1) {
        alert("Minimum quantity has achieved.");
        input.value = 1;
    } else {
        r.open("GET", "addToCartUpdateProcess.php?id=" + id + "&qty=" + input.value, true);
        r.send();
    }

}

function selectProvince() {
    var province = document.getElementById("pr");
    var district_box = document.getElementById("districtBox");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            district_box.innerHTML = t;
        }
    }

    r.open("GET", "selectProvinceProcess.php?id=" + province.value, true);
    r.send();

}

function deleteFromCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {

            var txt = r.responseText;

            if (txt == "success") {
                alert("Product removed from the cart");
                window.location = "cart.php";
            } else {
                alert(txt);
            }
        }

    }

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();

}

function cartSearch() {
    var searchtxt = document.getElementById("cartSearch");
    var cartProducts = document.getElementById("cartProducts");

    var f = new FormData();
    f.append("txt", searchtxt.value);

    var r = new XMLHttpRequest;
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            cartProducts.innerHTML = t;
        }
    }

    r.open("post", "cartSearchProcess.php", true);
    r.send(f);

}

function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "added") {

                window.location.reload();

            } else if (t == "removed") {

                window.location.reload();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();

}

function removeFromWatchlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                window.location.reload();
            } else {
                alert(text);
            }
        }
    }

    request.open("GET", "removeWatchlistProcess.php?id=" + id), true;
    request.send();

}

function watchlistSearch() {
    var searchtxt = document.getElementById("searchtxt");
    var watchlistProducts = document.getElementById("watchlistSearchProducts");

    var f = new FormData();
    f.append("txt", searchtxt.value);

    var r = new XMLHttpRequest;
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            watchlistProducts.innerHTML = t;
        }
    }

    r.open("post", "watchlistSearchProcess.php", true);
    r.send(f);

}

function removeFromRecent(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                window.location.reload();
            } else {
                alert(text);
            }
        }
    }

    request.open("GET", "removeRecentProcess.php?id=" + id), true;
    request.send();

}

function recentSearch() {
    var searchtxt = document.getElementById("searchtxt");
    var recentProducts = document.getElementById("RecentSearchProducts");

    var f = new FormData();
    f.append("txt", searchtxt.value);

    var r = new XMLHttpRequest;
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            recentProducts.innerHTML = t;
        }
    }

    r.open("post", "recentSearchProcess.php", true);
    r.send(f);

}

function buyNow(id) {
    var qty = document.getElementById("qtyInput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];


            if (t == "1") {
                alert("Please login.");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please Update your profile");
                window.location = "userProfile.php";
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
                    "merchant_id": "1221528",    // Replace your Merchant ID
                    "return_url": "http://localhost/viva/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/viva/singleProductView.php?id=" + id,     // Important
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
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                payhere.startPayment(payment);
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
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}

function m() {
    alert("ok");
}


function viewMessages(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewMsgProcess.php?e=" + email, true);
    r.send();

}

function send_msg() {
    var email = document.getElementById("rmail");
    var txt = document.getElementById("msg_txt");
    var img = document.getElementById("sendimg");

    var f = new FormData();
    f.append("e", email.innerHTML);
    f.append("t", txt.value);
    if (img.files.length == 0) {

    } else {
        f.append("image", img.files[0]);
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
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

function sendmsg() {
    var email = document.getElementById("rmail");
    var txt = document.getElementById("msg_txt");
    var img = document.getElementById("sendimg");

    var f = new FormData();
    f.append("e", email.innerHTML);
    f.append("t", txt.value);

    if (img.files.length == 0) {

    } else {
        f.append("image", img.files[0]);
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
    }

    r.open("POST", "msgSentProcess.php", true);
    r.send(f);
}

function UploadImage() {

    var view = document.getElementById("upImg"); //image tag
    var file = document.getElementById("sendimg"); //file chooser

    file.onchange = function () {

        var file1 = this.files[0];
        var url1 = window.URL.createObjectURL(file1);
        view.src = url1;

    }
}

var md;

function addFeedback(id) {

    var feed = document.getElementById("feedbackModal" + id);
    md = new bootstrap.Modal(feed);
    md.show();

}

function saveFeedback(id) {
    var feedb = document.getElementById("feed"+id).value;

    if (document.getElementById("type1"+id).checked) {
        type = 1;
    } else if (document.getElementById("type2"+id).checked) {
        type = 2;
    } else if (document.getElementById("type3"+id).checked){
        type = 3;
    }

    var r = new XMLHttpRequest();

    var f = new FormData();
    f.append("t", type);
    f.append("i", id);
    f.append("f", feedb);

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("Feedbak Saved");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

var pm;

function viewProductModal(id) {
    var m = document.getElementById("viewproductmodal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var mim;

function viewMsgImgModal(id) {
    var m = document.getElementById("viewMsgImgModal" + id);
    mim = new bootstrap.Modal(m);
    mim.show();
}

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("pb" + id).innerHTML = "Unblock";
                document.getElementById("pb" + id).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("pb" + id).innerHTML = "Block";
                document.getElementById("pb" + id).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();

}

var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var vc;
var e;
var n;

function verifyCategory() {
    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    f.append("email", e);
    f.append("name", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                cm.hide();
                vc.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);
}

function saveCategory() {

    var txt = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("e", e);
    f.append("n", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                vc.hide();
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveCategoryProcess.php", true);
    r.send(f);
}

var cdm;
var dcid;

function deleteCategory(id) {

    var confirmAction = confirm("If you delete this Category, all related items will be deleted. Do you still want to delete?");

    if (confirmAction) {
        dcid = id;
        var m = document.getElementById("deleteCategoryModal");
        cdm = new bootstrap.Modal(m);
        cdm.show();
    } else {
    }
}

var vdc;
var cde;

function verifydeleteCategory() {
    var ncm = document.getElementById("deleteCategoryVerificationModal");
    vdc = new bootstrap.Modal(ncm);

    cde = document.getElementById("cde").value;

    var f = new FormData();
    f.append("email", cde);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                cdm.hide();
                vdc.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "deleteCategoryverifyProcess.php", true);
    r.send(f);
}

function deleteverifyCategory() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                vdc.hide();
                alert("Category was deleted");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "deletecategoryProcess.php?id=" + dcid, true);
    r.send();
}

function deleteProduct(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Product deleted");
                window.location.reload();
            } else if (t == "sign in") {
                alert("Please sign in");
                window.location = "adminSignin.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "deleteProductProcess.php?id=" + id, true);
    r.send();
}

function searchInvoiceId() {
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "invalid Invoice Id") {
                alert(t);
                window.location.reload();
            } else {
                document.getElementById("viewArea").innerHTML = t;
            }
        }
    }

    r.open("GET", "searchInvoicedProcess.php?id=" + txt, true);
    r.send();
}

function findSellings() {

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("viewArea").innerHTML = t;

        }
    }

    r.open("GET", "findSellingsProcess.php?f=" + from + "&t=" + to, true);
    r.send();

}

function changeInvoiceStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {

                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "btn btn-warning fw-bold mt-1 mb-1";

            } else if (t == 2) {

                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold mt-1 mb-1";

            } else if (t == 3) {

                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold mt-1 mb-1";

            } else if (t == 4) {

                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "btn btn-danger fw-bold mt-1 mb-1 disabled";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();
}

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    r.open("GET", "userBlockProcess.php?email=" + email, true);
    r.send();

}

var mm;
var email1;
var xx;

function viewMsgModal(email, x) {
    xx = x;
    email1 = email;
    m = document.getElementById("userMsgModal" + email);
    mm = new bootstrap.Modal(m);
    mm.show();
}

function sendAdminMsg(email, id) {
    var txt = document.getElementById(id).value;

    var f = new FormData();
    f.append("t", txt);
    f.append("r", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                mm.hide();
                alert("message send. Check your Message Box");
            }
        }
    }

    r.open("POST", "sendAdmingMsgProcess.php", true);
    r.send(f);
}

function manageproductSearch() {
    var txt = document.getElementById("producttxt").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResults").innerHTML = t;
        }
    }
    r.open("GET", "manageProductsSearchProcess.php?txt=" + txt, true);
    r.send();
}

function manageUserSearch() {
    var txt = document.getElementById("userTxt").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("userSearchResult").innerHTML = t;
        }
    }
    r.open("GET", "manageUserSearchProcess.php?txt=" + txt, true);
    r.send();
}

reloadTimeAnimationNumber = 0;

function reloadTime() {
    var time = document.getElementById("time");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            time.innerHTML = t;

        }
    }

    r.open("POST", "adminPanelReload.php", true);
    r.send();

}

function reload() {
    reloadTimeAnimationNumber = setInterval(reloadTime, 100);
}

function backToSignIn() {
    window.location = "index.php";
}

function cartCheckOut() {
    var txt = document.getElementById("cartSearch").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];


            if (t == "1") {
                alert("Please login.");
                window.location = "index.php";
            } else {
                // Payment completed. It can be a successful failure.

                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice1(orderId, txt, mail, amount);
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
                    "merchant_id": "1221528",    // Replace your Merchant ID
                    "return_url": "http://localhost/viva/cart.php?",     // Important
                    "cancel_url": "http://localhost/viva/cart.php?",     // Important
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
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                payhere.startPayment(payment);
            }

        }
    }

    r.open("GET", "catBuyProcess.php?txt=" + txt, true);
    r.send();
}

function saveInvoice1(orderId, txt, mail, amount) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("t", txt);
    f.append("m", mail);
    f.append("a", amount);

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

    r.open("POST", "saveInvoice1.php", true);
    r.send(f);
}

function selectModel(){
    var category = document.getElementById("category");
    var productModelBox = document.getElementById("productModelBox");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            productModelBox.innerHTML = t;
        }
    }

    r.open("GET", "selectProductModelProcess.php?id=" + category.value, true);
    r.send();
}