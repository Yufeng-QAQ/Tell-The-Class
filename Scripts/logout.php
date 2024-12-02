<?php
if (isset($_COOKIE["local_user"])) {
    // Unset and expire the cookie
    unset($_COOKIE['local_user']);
    setcookie('local_user', '', -1, '/'); // Adjust path as needed
    // Redirect to Home.php
    header("Location: ../Home.php");
    exit;
} else {
    exit;
}
?>