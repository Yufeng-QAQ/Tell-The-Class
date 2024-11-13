<?php
    if(isset($_COOKIE["local_user"])) {
        unset($_COOKIE['local_user']); 
        setcookie('local_user', '', -1, '/'); 
        header("Location: ../Home.php");
        exit;
    } else {
        exit;
    }
?>