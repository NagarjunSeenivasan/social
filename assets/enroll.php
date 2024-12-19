<?php
// session_start();
// include 'connect.php';

// if (!isset($_SESSION['username'])) {
//     header("Location: ../student/index.php");
//     exit();
// }

// $student_username = $_SESSION['username'];
// $course_id = $_POST['course_id'];

// // Insert enrollment request
// $stmt = $conn->prepare("INSERT INTO enrollments (student_username, course_id) VALUES (?, ?)");
// $stmt->bind_param("si", $student_username, $course_id);
// $stmt->execute();

// $enrollment_id = $stmt->insert_id;

// // Insert admin request
// $admin_stmt = $conn->prepare("INSERT INTO admin_requests (enrollment_id) VALUES (?)");
// $admin_stmt->bind_param("i", $enrollment_id);
// $admin_stmt->execute();

// $stmt->close();
// $admin_stmt->close();
// $conn->close();

// // Redirect back to dashboard or course list
// header("Location: ../student/index.php");
// exit();
?>



<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../student/index.php");
    exit();
}

$student_username = $_SESSION['username'];
$course_id = $_POST['course_id'];

// Check if the student is already enrolled in the course
$check_stmt = $conn->prepare("
    SELECT * FROM enrollments 
    WHERE student_username = ? AND course_id = ?
");
$check_stmt->bind_param("si", $student_username, $course_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // If already enrolled, redirect back with an error message
    $check_stmt->close();
    $conn->close();
    header("Location: status/failure.php");
    exit();
}

// If not already enrolled, insert enrollment request
$stmt = $conn->prepare("INSERT INTO enrollments (student_username, course_id) VALUES (?, ?)");
$stmt->bind_param("si", $student_username, $course_id);
$stmt->execute();

$enrollment_id = $stmt->insert_id;

// Insert admin request
$admin_stmt = $conn->prepare("INSERT INTO admin_requests (enrollment_id) VALUES (?)");
$admin_stmt->bind_param("i", $enrollment_id);
$admin_stmt->execute();

$stmt->close();
$admin_stmt->close();
$conn->close();

// Redirect back to dashboard or course list
header("Location: status/success.php");
exit();
