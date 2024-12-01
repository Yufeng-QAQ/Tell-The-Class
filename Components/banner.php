 <!-- Banner HTML -->
<div class="banner" id="banner">
    <div class="banner-left">
        <img src="Image/Tail-logo.png" alt="Tail">
        <div class="navi-buttons">
            <a href="Home.php">
                <span class="navi-btn <?= ($currentPage === 'Home') ? 'selected' : '' ?>">
                    Home
                </span>
            </a>
            <a href="MyCourse.php">
                <span class="navi-btn <?= ($currentPage === 'MyCourse') ? 'selected' : '' ?>">
                    My Course
                </span>
            </a>
            <a href="Course_list.php">
                <span class="navi-btn <?= ($currentPage === 'Course_list') ? 'selected' : '' ?>">
                    Look-up Course
                </span>
            </a>
            <a href="FAQ.php">
                <span class="navi-btn <?= ($currentPage === 'FAQ') ? 'selected' : '' ?>">
                    Help
                </span>
            </a>
        </div>
    </div>

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


</div>