<?php
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
    if (mysqli_connect_errno()) {
        echo json_encode(["success" => false, "error" => "Database connection failed"]);
        exit();
    }

    // Change encoding
    mysqli_set_charset($db, "utf8mb4");

    // Retrieve comments for a specific course code
    $course_code = mysqli_real_escape_string($db, htmlspecialchars($_GET['course_code']));

    // Fetch comments for the given course_code
    $query = "SELECT * FROM comments WHERE course_code = '$course_code'";
    $result = mysqli_query($db, $query);

    if (!$result) {
        echo json_encode(["success" => false, "error" => mysqli_error($db)]);
        exit();
    }

    $comments = [];
    while ($row = mysqli_fetch_array($result)) {
        $comments[] = $row;
    }

    echo json_encode(["success" => true, "comments" => $comments]);

    mysqli_close($db);

?>