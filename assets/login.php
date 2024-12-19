<?php
include 'connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Table selection based on user type
    $table = ($user_type === "student") ? "students" : "staff";

    // Fetch the user data
    $stmt = $conn->prepare("SELECT * FROM $table WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Store username in session
        $_SESSION['username'] = $username;

        if ($user_type === "student") {
            header("Location: ../workbench/dashboard.php");
        } else {
            header("Location: ../staff/index.html");
        }
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
