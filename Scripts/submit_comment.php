<?php
    //Connect to the database
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
    if (mysqli_connect_errno()) {
        exit("Error - could not connect to MySQL");
    }


    