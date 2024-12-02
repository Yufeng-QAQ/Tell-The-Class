"use strict"
var result_box = "";
window.onload = pageLoad;

function pageLoad() {
    if (window.location.pathname.endsWith("Create_account.php")) {
        $("html_uname").onkeyup = ifTaken;
        $("html_pword").onkeyup = ifGood;
        $("html_re_pword").onkeyup = ifMatching;
        $("sign_in_button").onclick = ifSignIn;
    } else if (window.location.pathname.endsWith("orget_account.html")) {
        $("forgot_uname").onkeyup = forgotPass;
        $("forgot_pword").onkeyup = checkPass;
        $("sign_in_button").onclick = updatePass;
    } else if (window.location.pathname.endsWith("Home.php")) {
        $("sign_in_form").onsubmit = signIn;
    }
}

function signIn(event) {
   event.preventDefault();

    result_box = "";
    var uname = $("html_uname").value;
    var pword = $("html_pword").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { ck_pword: pword, ck_uname: uname, checkingType: "signin", page: "home" },
            onSuccess: displayResult
        }
    );
}

function ifTaken() {
    result_box = "isAvail";
    var uname = $("html_uname").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { ck_uname: uname, checkingType: "iftaken", page: "create" },
            onSuccess: displayResult
        }
    );
}

function ifGood() {
    result_box = "isGood";
    var pword = $("html_pword").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { ck_pword: pword, checkingType: "ifgood", page: "create" },
            onSuccess: displayResult
        }
    );
}

function ifMatching() {
    result_box = "ifMatch";
    var pword1 = $("html_pword").value;
    var pword2 = $("html_re_pword").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { match1: pword1, match2: pword2, checkingType: "ifmatch", page: "create" },
            onSuccess: displayResult
        }
    );
}

function ifSignIn() {
    result_box == "";
    var uname = $("html_uname").value;
    var pword1 = $("html_pword").value;
    var pword2 = $("html_re_pword").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { match1: pword1, match2: pword2, ck_pword: pword1, ck_uname: uname, checkingType: "ifsignin", page: "create" },
            onSuccess: displayResult
        }
    );
}

function forgotPass() {
    result_box = "ifFound";
    var uname = $("forgot_uname").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { ck_uname: uname, checkingType: "iffound", page: "forgot" },
            onSuccess: displayResult
        }
    );
}

function checkPass() {
    result_box = "isGood";
    var pword = $("forgot_pword").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { ck_pword: pword, checkingType: "ifgood", page: "forgot" },
            onSuccess: displayResult
        }
    );
}

function updatePass() {
    result_box = "";
    var uname = $("forgot_uname").value;
    var pword = $("forgot_pword").value;
    new Ajax.Request("Scripts/Home/Check.php",
        {
            method: "POST",
            parameters: { ck_pword: pword, ck_uname: uname, checkingType: "update", page: "forgot" },
            onSuccess: displayResult
        }
    );
}



//the displayResult function is executed when the Ajax request is successful
//ajax must be sent as parameter to this function
function displayResult(ajax) {
    if (ajax.responseText == "success") {
        alert("Your account has been successfully created!");
        window.location.href = "Home.php";

    } else if (ajax.responseText == "updated") {
        alert("Your password has been successfully updated!");
        window.location.href = "Home.php";

    } else if (ajax.responseText == "SignedIn") {
        window.location.href = "Home.php";
    } else if (ajax.responseText == "Failed") {
        alert("Invalid username or password.");

    } else if (result_box == "isGood") {
        $("isGood").innerHTML = ajax.responseText;

    } else if (result_box == "ifMatch") {
        $("ifMatch").innerHTML = ajax.responseText;

    } else if (result_box == "isAvail") {
        $("isAvail").innerHTML = ajax.responseText;

    } else if (result_box == "ifFound") {
        $("ifFound").innerHTML = ajax.responseText;

    }
}
