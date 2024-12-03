<?php
// Connect to the database
$db = mysqli_connect("studentdb-maria.gl.umbc.edu","yufengl1","yufengl1","yufengl1");
if(mysqli_connect_errno()) {
    echo "Error - could not connect to MySQL";
    exit;
}

// Sanitize input data using prepared statements
$subject = htmlspecialchars($_POST['Subject']);
$catalogNumber = htmlspecialchars($_POST['Catalog']);
$courseName = htmlspecialchars($_POST['Course_name']);
$professorName = htmlspecialchars($_POST['Professor_name']);
$creditNumber = htmlspecialchars($_POST['Credit_number']);
$finalGrade = htmlspecialchars($_POST['Grade']);
$term = htmlspecialchars($_POST['Terms']);

$courseName = mysqli_real_escape_string($db, $courseName);

$curr_user = "";

// Check if user is logged in
if (isset($_COOKIE['local_user'])) {
    $curr_user = htmlspecialchars($_COOKIE['local_user']);
    $curr_user = mysqli_real_escape_string($db, $curr_user);
} else {
    echo "You have not logged in.";
    exit;
}


$query = "SELECT * FROM enrollments WHERE user = '$curr_user' AND course_name = '$courseName'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Error: The course \"$courseName\" is already exist in your record.";
    exit;
}


// Prevent SQL injection
$subject = mysqli_real_escape_string($db, $subject);
$catalogNumber = mysqli_real_escape_string($db, $catalogNumber);
$professorName = mysqli_real_escape_string($db, $professorName);
$creditNumber = mysqli_real_escape_string($db, $creditNumber);
$finalGrade = mysqli_real_escape_string($db, $finalGrade);
$term = mysqli_real_escape_string($db, $term);


$constructed_query = "INSERT INTO enrollments (subject, user, catalog, course_name, prof_name, credit_number, grade, term) 
            VALUES ('$subject', '$curr_user', '$catalogNumber', '$courseName', '$professorName', '$creditNumber', '$finalGrade', '$term')";
    

$result = mysqli_query($db, $constructed_query);

// Check for errors
if (!$result) {
    print("Error - query could not be executed");
    $error = mysqli_error($db);
    echo "Error - query could not be executed: $error";
}else{
    // Redirect to MyCourse page after 3 seconds
    echo "Success! The course \"$courseName\" has been added to your record.";
}
mysqli_close($db);

?>
