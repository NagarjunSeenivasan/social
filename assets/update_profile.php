<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../student/index.php");
    exit();
}

$username = $_SESSION['username'];

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone_number'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$institution = $_POST['institution'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password && $password === $confirm_password) {
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $password_sql = ", password = '$password_hash'";
} else {
    $password_sql = "";
}

// Handle file upload if a new photo is provided
if (!empty($_FILES['photo']['name'])) {
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        $photo_sql = ", photo = '$photo'";
    } else {
        $photo_sql = "";
    }
} else {
    $photo_sql = "";
}

// Update the student's profile
$update_stmt = $conn->prepare("
    UPDATE students 
    SET firstname = ?, lastname = ?, phone_number = ?, dob = ?, address = ?, institution = ? $photo_sql $password_sql 
    WHERE username = ?
");
$update_stmt->bind_param("sssssss", $firstname, $lastname, $phone, $dob, $address, $institution, $username);
$update_stmt->execute();

$update_stmt->close();
$conn->close();

header("Location: ");
exit();
?>
