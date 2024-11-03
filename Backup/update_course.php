
<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Course page</title>
    <link rel="stylesheet" type="text/css" href="form_proc.css" />
</head>

<body>


<?php
//Zhenqi Huang
$db = mysqli_connect("studentdb-maria.gl.umbc.edu","zhenqih1","zhenqih1","zhenqih1");
if(mysqli_connect_errno())
    exit("Error - could not connect to MySQL");
$id = htmlspecialchars($_POST['course_id']);
$subject = htmlspecialchars($_POST['current_subject']);
$catalogNumber = htmlspecialchars($_POST['current_catalog']);
$courseName = htmlspecialchars($_POST['new_course_name']);
$professorName = htmlspecialchars($_POST['new_professor_name']);
$creditNumber = htmlspecialchars($_POST['new_credit_number']);
$finalGrade = htmlspecialchars($_POST['new_Grade']);
$term = htmlspecialchars($_POST['new_Terms']);

// Input validation
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

$constructed_query = "UPDATE mycourse SET 
                subject = '$subject', 
                catalog = '$catalogNumber', 
                course_name = '$courseName', 
                prof_name = '$professorName', 
                credit_number = '$creditNumber', 
                grade = '$finalGrade', 
                term = '$term' 
              WHERE course_id = $id";

print("CHECK PROGRAM IS WORKING MESSAGE: The query is: $constructed_query<br>");

$result = mysqli_query($db, $constructed_query);

// Check for errors
if (!$result) {
    print("Error - query could not be executed");
    $error = mysqli_error($db); // Pass the database connection as a parameter
    print "<p>$error</p>"; // Correct the print statement
    exit;
} else {
    echo "Hello";
}
?>



</body>
</html>
