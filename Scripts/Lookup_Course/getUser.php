<?php
    // Check if the 'username' cookie is set
    $username = isset($_COOKIE['local_user']) ? $_COOKIE['local_user'] : 'Null';

    // Return the username in JSON format
    echo json_encode(['user' => $username]);
?>