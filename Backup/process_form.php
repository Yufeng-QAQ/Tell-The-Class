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
        exit;
    }
    if (!preg_match("/^\d+$/", $catalogNumber)) {
        print("Valid catalog number is required (numeric only).");
        exit;
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $courseName)) {
        print("Course name is required and can contain letters and whitespace.");
        exit;
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $professorName)) {
        print("Professor name is required and should contain only letters and whitespace.");
        exit;
    }
    if (!preg_match("/^[1-6]$/", $creditNumber)) {
        print("Valid number of credits is required (1-6).");
        exit;
    }
    if (!preg_match("/^[A-F]$/", $finalGrade)) {
        print("Final grade is required and must be a letter grade (A-F).");
        exit;
    }
    if (!preg_match("/^\d{4}$/", $term)) {
        print("Term is required and must be a four-digit year (e.g., 2024).");
        exit;
    }
    
    
    ?>



    <?php
    $constructed_query = "INSERT INTO mycourse (subject, catalog, course_name, prof_name, credit_number, grade, term) VALUES ('$subject', '$catalogNumber', '$courseName', '$professorName', '$creditNumber', '$finalGrade', '$term')";
        
    print("CHECK PROGRAM IS WORKING MESSAGE: The query is: $constructed_query</br>");

    $result = mysqli_query($db, $constructed_query);


    // Check for errors
    if (! $result) {
        print("Error - query could not be executed");
		$error = mysqli_error($db);
		print "<p> . $error . </p>";
		exit;

    }else{
        echo "Hello";
    }
    
?>


</body>
</html>
