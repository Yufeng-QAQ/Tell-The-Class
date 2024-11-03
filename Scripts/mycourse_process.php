<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Course page</title>
    <link rel="stylesheet" type="text/css" href="form_proc.css" />
</head>

<body>

<?php
//Zhenqi Huang

// Connect to the database
$db = mysqli_connect("studentdb-maria.gl.umbc.edu","zhenqih1","zhenqih1","zhenqih1");

if(mysqli_connect_errno())
    exit("Error - could not connect to MySQL");

// Check if the form is submitted

    // Sanitize input data using prepared statements
    $subject = htmlspecialchars($_POST['Subject']);
    $catalogNumber = htmlspecialchars($_POST['Catalog']);
    $courseName = htmlspecialchars($_POST['Course_name']);
    $professorName = htmlspecialchars($_POST['Professor_name']);
    $creditNumber = htmlspecialchars($_POST['Credit_number']);
    $finalGrade = htmlspecialchars($_POST['Grade']);
    $term = htmlspecialchars($_POST['Terms']);

    // Validate inputs
    
    if (!preg_match("/^[a-zA-Z\s]+$/", $subject)) {
        print("Subject is required and should contain only letters and whitespace.");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    if (!preg_match("/^\d+$/", $catalogNumber)) {
        print("Valid catalog number is required (numeric only).");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $courseName)) {
        print("Course name is required and can contain letters and whitespace.");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $professorName)) {
        print("Professor name is required and should contain only letters and whitespace.");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    if (!preg_match("/^[1-6]$/", $creditNumber)) {
        print("Valid number of credits is required (1-6).");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    if (!preg_match("/^[A-F]$/", $finalGrade)) {
        print("Final grade is required and must be a letter grade (A-F).");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    if (!preg_match("/^(Fall|Winter|Spring|Summer) \d{4}$/", $term)) {
        print("Term is required and must be in the format 'Fall YYYY', 'Winter YYYY', 'Spring YYYY', or 'Summer YYYY', where YYYY is a four-digit year.");
        echo " <a href='../MyCourse.php'>Go Back<a/>";
        exit;
    }
    
    
    ?>



    <?php

    $curr_user = "Tail";

    $constructed_query = "INSERT INTO enrollments (subject, user, catalog, course_name, prof_name, credit_number, grade, term) 
                VALUES ('$subject', '$$curr_user', '$catalogNumber', '$courseName', '$professorName', '$creditNumber', '$finalGrade', '$term')";
        
    print("CHECK PROGRAM IS WORKING MESSAGE: The query is: $constructed_query</br>");

    $result = mysqli_query($db, $constructed_query);

    // Check for errors
    if (! $result) {
        print("Error - query could not be executed");
		$error = mysqli_error($db);
		print "<p> . $error . </p>";
		exit;

    }else{
        // Redirect to MyCourse page after 3 seconds
        echo "<script>
            setTimeout(function() {
                window.location.href = '../MyCourse.php';
            }, 3000);
        </script>";
    }
    
?>


</body>
</html>
