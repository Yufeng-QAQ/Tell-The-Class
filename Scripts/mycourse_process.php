<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Course page</title>
    <link rel="stylesheet" href="../Styles/Feedback.css">
</head>

<body>
    <?php
    // Connect to the database
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu","yufengl1","yufengl1","yufengl1");

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

    $courseName = mysqli_real_escape_string($db, $courseName);

    // Validate inputs
    $passed = true;

    $curr_user = "";

    // Check if user is logged in
    if (isset($_COOKIE['local_user'])) {
        $curr_user = htmlspecialchars($_COOKIE['local_user']);
        $curr_user = mysqli_real_escape_string($db, $curr_user);
    } else {
        $passed = false;
        echo "<div class='message error'>
                <p>Error: You have not logged in.</p>
            </div>";
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $subject)) {
        $passed = false;
        echo "<div class='message error'>
                <p>Error: Subject is required and should contain only letters and whitespace.</p>
            </div>";
    }
    if (!preg_match("/^\d+$/", $catalogNumber)) {
        $passed = false;
        echo "<div class='message error'>
                <p>Valid catalog number is required (numeric only).</p>
            </div>";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $courseName)) {
        $passed = false;
        echo "<div class='message error'>
                <p>Course name is required and can contain letters and whitespace.</p>
            </div>";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $professorName)) {
        $passed = false;
        echo "<div class='message error'>
                <p>Professor name is required and should contain only letters and whitespace.</p>
            </div>";
    }
    if (!preg_match("/^[1-6]$/", $creditNumber)) {
        $passed = false;
        echo "<div class='message error'>
                <p>A valid number of credits is required (1-6).</p>
            </div>";
    }
    if (!preg_match("/^[A-F]$/", $finalGrade)) {
        $passed = false;
        echo "<div class='message error'>
                <p>Final grade is required and must be a letter grade (A-F).</p>
            </div>";
    }
    if (!preg_match("/^(Fall|Winter|Spring|Summer) \d{4}$/", $term)) {
        $passed = false;
        echo "<div class='message error'>
                <p>Term is required and must be in the format 'Fall YYYY', 'Winter YYYY', 'Spring YYYY', or 'Summer YYYY', where YYYY is a four-digit year.</p>
            </div>";
    }

    $query = "SELECT * FROM enrollments WHERE user = '$curr_user' AND course_name = '$courseName'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $passed = false;
        echo "<div class='message error'>
                <p>Error: The course \"$courseName\" already exist in your record.</p>
            </div>";
    }

    if (!$passed) {
        echo "<div class='message error'>
                <a href='../MyCourse.php'>Go Back<a/>
            </div>";
        mysqli_close($db);
        exit;
    }
    
    ?>


    <?php
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
        echo "<div class='message error'>
                <p>Error - query could not be executed: $error</p>
            </div>";
        mysqli_close($db);
		exit;

    }else{
        mysqli_close($db);
        // Redirect to MyCourse page after 3 seconds
        echo "<div class='message success'>
                <p>Success! The course \"$courseName\" has been added to your record.</p>
                <a href='../MyCourse.php'>Go Back<a/>
            </div>";

        echo "<script>
            setTimeout(function() {
                window.location.href = '../MyCourse.php';
            }, 3000);
        </script>";
    }
    
?>


</body>
</html>
