<?php
    if (isset($_COOKIE['local_user'])) {
        $user = $_COOKIE['local_user'];
        echo "<form action='Scripts/logout.php' method='post'>
                <button class='login' type='submit'title='Logout'>
                    $user
                </button>
            </form>";
    } else {
        echo "<a href='Home.php'>
                <span class='login'>
                    Login
                </span>
            </a>";
    }
    ?>