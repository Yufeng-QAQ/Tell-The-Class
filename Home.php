<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="Styles/Home.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="Styles/Banner.css">
    <title>Home</title>
</head>

<body>
    <!-- Banner HTML -->
    <!-- Banner HTML -->
    <?php 
        $currentPage = 'Home';
        include 'Components/banner.php';
    ?>

    <div class="home-content">
        <!-- the sign in section -->
        <div class="Sign-in">
            <p id="Sign_in_title">
                Sign In
            </p>
            <!-- form type for future implementations -->
            <form class="sign_in_form" action="home.html" method="POST">
                <div class="login-info">
                    <p><label>
                            Username<br />
                            <input class="account_input" type="text" name="username" size="30" />
                        </label></p>
                    <p><label>
                            Password <br />
                            <input class="account_input" type="password" name="password" size="30" />
                        </label></p>
                </div>
                <!-- id to account means to the account page -->
                <p id="to_account">
                    <a href="forget_account.html"> Forget Password &rarr;
                    </a>
                    <br />
                    <a href="create_account.html"> Create Account
                        &rarr; </a>

                </p>
                <button id="sign_in_button" type="button">Sign in</button>
            </form>
        </div>

    </div>
    


    <!-- The links at the bottom to traverse to different pages -->
    <div class="Bottom">
        <p>
            <a href="Home.html"> Home</a>
            /
            <a href="MyCourse.html"> My Course </a>
            /
            <a href="FAQ.html"> Help</a>
        </p>
    </div>

</body>