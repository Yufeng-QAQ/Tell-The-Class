<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Feedback.css">
    <title>Home</title>
</head>
<body>
    <?php
    //check if logged in
    if(isset($_COOKIE["local_user"]))
    {   
        header("Location: ../Home.php");
        exit();
    }

    //open db
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
    if (mysqli_connect_errno()) {
        exit("Error connecting to database");
    }

    //get data from post
    $php_username = mysqli_real_escape_string($db, $_POST['html_username']);
    $php_password = mysqli_real_escape_string($db, $_POST['html_password']);
    $constructed_query = "SELECT username FROM users WHERE username ='$php_username' AND password = '$php_password'";
    $result = mysqli_query($db,$constructed_query);

    //if found in db
    if (mysqli_num_rows($result) > 0) {
        //get id
        $row = mysqli_fetch_array($result);
        $php_user = $row['username'];
        //set cookie
        setcookie("local_user",$php_user, time()+86400, "/");
        mysqli_close($db);

        header("Location: ../Home.php");
        exit();
    }else{
        //if not found in db
        echo "<div class='message error'>
                <p>Error: Invalid username or password.</p>
            </div>";
        setcookie("local_user", "");

        echo "<script>
            setTimeout(function() {
                window.location.href = '../Home.php';
            }, 2000);
        </script>";




        
    }

    ?>
</body>
</html>
