<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="Styles/Home.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="Styles/Banner.css">
    <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js" type="text/javascript"></script>
    <script src="Scripts/Home/Check.js"></script>
    <title>Home</title>
</head>

<body>
    <!-- Banner HTML -->
    <?php 
        $currentPage = 'Home';
        include 'Components/banner.php';
    ?>

    <div class="home-content">
        <!-- the sign in section -->
        <div class="Sign-in">
    

            <?php
                if (isset($_COOKIE["local_user"])) {
                    echo "<p class='welcome-msg'>Welcome, " . $_COOKIE['local_user'] . "!</p>";
                } else {
                    echo "<p id='Sign_in_title'>
                            Sign In
                        </p>
                        <form class='sign_in_form' name='sign_in_form' action='' method='POST'>
                            <div class='login-info'>
                                <p><label>
                                    Username<br />
                                    <input class='account_input' type='text' name='html_username' size='30' />
                                </label></p>
                                <p><label>
                                    Password <br />
                                    <input class='account_input' type='password' name='html_password' size='30' />
                                </label></p>
                            </div>
                            <p id='to_account'>
                                <a href='Forget_account.html'> Forget Password &rarr;
                                </a>
                                <br />
                                <a href='Create_account.php'> Create Account
                                    &rarr; </a>
                            </p>
                            <button id='sign_in_button' type='submit'>Sign in</button>
                        </form>";
                }
            
            ?>
        </div>
    </div>
    


    <!-- The links at the bottom to traverse to different pages -->
    <div class="Bottom">
        <p>
            <a href="Home.php"> Home</a>
            |
            <a href="MyCourse.php"> My Course </a>
            |
            <a href="FAQ.php"> Help</a>
        </p>
    </div>

</body>