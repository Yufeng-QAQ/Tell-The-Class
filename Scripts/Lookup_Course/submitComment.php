<?php
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
    if (mysqli_connect_errno()) {
        exit(json_encode(["success" => false, "error" => "Database connection failed"]));
    }

    // Change encoding
    mysqli_set_charset($db ,"utf8mb4");
    
    // Prevent HTML / SQL injection
    $php_course_code = mysqli_real_escape_string($db, htmlspecialchars($_POST['course_code']));
    $php_user = mysqli_real_escape_string($db, htmlspecialchars($_POST['user']));
    $php_grade = mysqli_real_escape_string($db, htmlspecialchars($_POST['grade']));
    $php_professor_name = mysqli_real_escape_string($db, htmlspecialchars($_POST['professor_name']));
    $php_date = mysqli_real_escape_string($db, htmlspecialchars($_POST['date']));
    $php_comment = mysqli_real_escape_string($db, htmlspecialchars($_POST['comment']));

    // Construct query
    $query = "INSERT INTO comments (course_code, username, grade, prof_name, comment, date) 
                VALUES ('$php_course_code', '$php_user', '$php_grade', '$php_professor_name', '$php_comment', '$php_date')";

    $result = mysqli_query($db, $query);

    // Return query feedback
    if ($result) $isSuccess = true;
    else {
        $error = mysqli_error($db);
        echo json_encode(["success" => false, "error" => $error]);
    }
    echo json_encode(["success" => true]);
    mysqli_close($db);
?>