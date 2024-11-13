<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="Styles/Banner.css">
    <link href="Styles/Home.css" rel="stylesheet" type="text/css" />
    <title>Sign In</title>
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
                Create Account
            </p>
        
            <!-- form type for future implementations -->
            <form class="sign_in_form" action="Scripts/register_user.php" method="POST">
                <div class="login-info">
                    <p><label>
                            Username<br />
                            <input class="account_input" type="text" name="html_username" size="30" />
                        </label></p>
                    <p><label>
                            Password <br />
                            <input class="account_input" type="password" name="html_password" size="30" />
                        </label></p>
                    <p><label>
                            Re-enter Password <br />
                            <input class="account_input" type="password" name="html_re_password" size="30" />
                        </label></p>
                </div>
                <button id="sign_in_button" type="submit">Register</button>
            </form>
        </div>
    </div>

</body>