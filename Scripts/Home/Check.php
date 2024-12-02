<?php
$check = $_POST["checkingType"];
$result = "";
$pass = TRUE;
if($_POST["page"] == "create"){
    if ($check == "iftaken" || $check == "ifsignin"){
        //open db
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
        if (mysqli_connect_errno()) {
            exit("Error connecting to database");
        }
        //get data from post and db
        $php_username = mysqli_real_escape_string($db, $_POST["ck_uname"]);
        $constructed_query = "SELECT * FROM users WHERE username ='$php_username'";
        $q = mysqli_query($db,$constructed_query);

        //if already exist
        if (mysqli_num_rows($q) > 0) {
            $result =  "Username has been taken" ;
            $pass = FALSE;
        }
        mysqli_close($db);
    }

    if ($check == "ifmatch" || $check == "ifsignin"){
        $q1=$_POST["match1"];
        $q2=$_POST["match2"];

        if($q1 == $q2){
            $result = "";
        }
        else{
            $result = "The passwords does not match";
            $pass = FALSE;
        }
    }

    if ($check == "ifgood" || $check == "ifsignin"){
        $q1 = $_POST["ck_pword"];
        if (!preg_match("/[a-zA-Z]/", $q1) || !preg_match("/\d/", $q1)){
            $result = "Password must include a number and letter";
            $pass = FALSE;
        }
    }

    if ($pass == True && $check == "ifsignin"){
        if(strlen($_POST["ck_uname"]) > 0 && strlen($_POST["match1"]) > 1 && strlen($_POST["match2"]) > 1 ){
            $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
            if (mysqli_connect_errno()) {
                exit("Error connecting to database");
            }
            $php_username = mysqli_real_escape_string($db, $_POST["ck_uname"]);
            $php_password = mysqli_real_escape_string($db, $_POST["ck_pword"]);
            $constructed_query = "INSERT INTO `users` (`username`, `password`) VALUES ('$php_username', '$php_password')";
            $r = mysqli_query($db,$constructed_query);
            mysqli_close($db);
            $result = "success";
        }
    }

}else if($_POST["page"] == "forgot"){
    if ($check == "iffound" || $check == "update"){
        //open db
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
        if (mysqli_connect_errno()) {
            exit("Error connecting to database");
        }
        //get data from post and db
        $php_username = mysqli_real_escape_string($db, $_POST["ck_uname"]);
        $constructed_query = "SELECT * FROM users WHERE username ='$php_username'";
        $q = mysqli_query($db,$constructed_query);

        //if already exist
        if (mysqli_num_rows($q) <= 0) {
            $result =  "Username not found" ;
            $pass = FALSE;
        }
        mysqli_close($db);
    }

    if ($check == "ifgood" || $check == "update"){
        $q1 = $_POST["ck_pword"];
        if (!preg_match("/[a-zA-Z]/", $q1) || !preg_match("/\d/", $q1)){
            $result = "Password must include a number and letter";
            $pass = FALSE;
        }
    }

    if ($pass == True && $check == "update"){
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
        if (mysqli_connect_errno()) {
            exit("Error connecting to database");
        }
        $php_username = mysqli_real_escape_string($db, $_POST["ck_uname"]);
        $php_password = mysqli_real_escape_string($db, $_POST["ck_pword"]);
        $constructed_query = "UPDATE `users` SET `password` = '$php_password' WHERE `users`.`username` = '$php_username'";
        $q= mysqli_query($db,$constructed_query);
        mysqli_close($db);
        $result = "updated";
    }

}else if($_POST["page"] == "home"){
    if(strlen($_POST["ck_uname"]) > 0 && strlen($_POST["ck_pword"]) > 1){
        //open db
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
        if (mysqli_connect_errno()) {
            exit("Error connecting to database");
        }
        //get data from post
        $php_username = mysqli_real_escape_string($db, $_POST["ck_uname"]);
        $php_password = mysqli_real_escape_string($db, $_POST["ck_pword"]);
        $constructed_query = "SELECT `username` FROM `users` WHERE `username` ='$php_username' AND `password` = '$php_password'";
        $q = mysqli_query($db,$constructed_query);

        //if found in db
        if (mysqli_num_rows($q) > 0) {
            //get id
            $row = mysqli_fetch_array($q);
            $php_user_id = $row['username'];
            //set cookie
            setcookie("local_user",$php_user_id, time()+86400, "/");
            mysqli_close($db);
            //go to mycourse
            $result = "SignedIn";
            
        }else{
            //if not found in db
            $result = "Failed";
        }   

    }else{      
        $result = "Failed";
    } 
}

echo $result;
?>