<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="Styles/Banner.css">
    <link rel="stylesheet" href="Styles/Feedback.css">
    <link href="Styles/Home.css" rel="stylesheet" type="text/css" />
    <title>Home</title>
</head>

<body>
    <!-- Banner HTML -->
    <?php 
        $currentPage = 'Home';
        include 'Components/banner.php';
    ?>

    <div class="home-content">
        <div class="Sign-in">
            <p id="Sign_in_title">
                Forget Account
            </p>
            <!-- form type for future implementations -->
            <form class="sign_in_form" action="forget_account.html" method="POST">
                <div class="login-info">
                    <?php 
                    //open db
                    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
                    if (mysqli_connect_errno()) {
                        exit("Error connecting to database");
                    }
                    //get data from post
                    $php_username = mysqli_real_escape_string($db, $_POST['html_username']);
                    $php_password = mysqli_real_escape_string($db, $_POST['html_password']);

                    $constructed_query = "SELECT password FROM users WHERE username ='$php_username'";
                    $result = mysqli_query($db,$constructed_query);

                    if (mysqli_num_rows($result) <= 0) {
                        //if not found in db
                        echo "<p id = \"invalid-login\"> Invalid username<br /></p>\n";
                        echo "</div>\n";
                        echo '<button id="sign_in_button" type="submit">Resubmit</button>';

                    }else if (!preg_match("/[a-zA-Z]/", $php_password) || !preg_match("/\d/", $php_password)){
                        echo '<p id = "invalid-login"> The password must include number and letter</p>';
                        echo "</div>\n";
                        echo '<button id="sign_in_button" type="submit">Resubmit</button>';

                    }else{
                        $constructed_query = "UPDATE `users` SET `password` = '$php_password' WHERE `users`.`username` = '$php_username'";
                        $result = mysqli_query($db,$constructed_query);
                        echo '<p id = "invalid-login"> Your password has been reset!</p>';
                        echo '</div>';
                        
                    }
                    mysqli_close($db);
                    ?>
            </form>
        </div>
    </div>

</body>