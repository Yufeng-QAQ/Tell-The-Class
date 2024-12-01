<?php

    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $catalog = $_POST['catalog'];
    $name = $_POST['name'];
    $professor = $_POST['professor'];
    $credit = $_POST['credit'];
    $grade = $_POST['grade'];
    $term = $_POST['term'];


        $db = mysqli_connect("studentdb-maria.gl.umbc.edu","zhenqih1","zhenqih1","zhenqih1");

        if(mysqli_connect_errno())
            exit("Error - could not connect to MySQL");

            $query = "UPDATE enrollments 
            SET subject = '$subject', catalog = '$catalog', course_name = '$name', prof_name = '$professor', 
                credit_number = '$credit', grade = '$grade', term = '$term' 
            WHERE course_id = '$id'";



    $result = mysqli_query($db, $query);

    if ($result) {
        // 返回成功消息
        echo "Class updated successfully!";
    } else {
        // 返回错误消息
        echo "Error updating class: " . mysqli_error($db);
    }


?>


