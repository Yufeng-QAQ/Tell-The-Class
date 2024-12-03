<?php
    $curr_user = "";

    $db = mysqli_connect("studentdb-maria.gl.umbc.edu","yufengl1","yufengl1","yufengl1");
    if(mysqli_connect_errno()) {
        echo "Error - could not connect to MySQL";
        exit;
    }
    
    // Check if user is logged in
    if (isset($_COOKIE['local_user'])) {
        $curr_user = htmlspecialchars($_COOKIE['local_user']);
        $curr_user = mysqli_real_escape_string($db, $curr_user);
    } else {
        echo "You have not logged in.";
        exit;
    }


    $id = htmlspecialchars($_POST['id']);
    $subject = htmlspecialchars($_POST['subject']);
    $catalog = htmlspecialchars($_POST['catalog']);
    $name = htmlspecialchars($_POST['name']);
    $professor = htmlspecialchars($_POST['professor']);
    $credit = htmlspecialchars($_POST['credit']);
    $grade = htmlspecialchars($_POST['grade']);
    $term = htmlspecialchars($_POST['term']);


    $query = "SELECT * FROM enrollments WHERE user = '$curr_user' AND course_name = '$name'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Error: The course \"$name\" is already exist in your record.";
        exit;
    }


    $query = "UPDATE enrollments 
            SET subject = '$subject', catalog = '$catalog', course_name = '$name', prof_name = '$professor', 
                credit_number = '$credit', grade = '$grade', term = '$term' 
            WHERE course_id = '$id'";

    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Class updated successfully!";
    } else {
        echo "Error updating class: " . mysqli_error($db);
    }

    mysqli_close($db);
?>


