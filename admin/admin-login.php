<?php
// admin-login.php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded credentials for simplicity
    $correct_username = 'cadibel';
    $correct_password = '2024';

    if ($username === $correct_username && $password === $correct_password) {
        // Redirect to admin dashboard or home page
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin-dashboard.php');
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
