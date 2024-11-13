<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="../Styles/Home.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../Styles/Feedback.css">
    <title>Create Account</title>
</head>
<body>
    <?php 
        //open db
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
        if (mysqli_connect_errno()) {
            exit("Error connecting to database");
        }
        //get data from post and db
        $php_username = mysqli_real_escape_string($db, $_POST['html_username']);
        $php_password = mysqli_real_escape_string($db, $_POST['html_password']);
        $php_re_password = mysqli_real_escape_string($db, $_POST['html_re_password']);
        $constructed_query = "SELECT * FROM users WHERE username ='$php_username'";
        $result = mysqli_query($db,$constructed_query);

        //if already exist
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='message error'>
                    <p>Username has been taken </p>
                    <a href='../Home.php'>Return Home<a/>
                </div>";

        } else if (!preg_match("/[a-zA-Z]/", $php_password) || !preg_match("/\d/", $php_password)){
            echo "<div class='message error'>
                    <p>The password must include number and letter. </p>
                    <a href='../Home.php'>Try Again<a/>
                </div>";

        } else if (!($php_password == $php_re_password)) {
            //if mismatching passwod
            echo "<div class='message error'>
                    <p>Passwords does not match. </p>
                    <a href='../Home.php'>Try Again<a/>
                </div>";

        } else{
            //else insert into db
            $constructed_query = "INSERT INTO `users` (`username`, `password`) VALUES ('$php_username', '$php_password')";
            $result = mysqli_query($db,$constructed_query);

            echo "<div class='message success'>
                    <p>Account successfully created! </p>
                    <a href='../Home.php'>Return Home<a/>
                </div>";

            echo "<script>
                    setTimeout(function() {
                        window.location.href = '../Home.php';
                    }, 2000);
                </script>";
        }                
    
        mysqli_close($db);
    ?>
</body>
</html>