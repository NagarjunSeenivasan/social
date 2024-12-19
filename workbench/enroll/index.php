<?php
session_start();
include '../../assets/connect.php';  // Adjust the path as needed

if (!isset($_SESSION['username'])) {
    header("Location: ../student/index.php");  // Redirect to login if session not found
    exit();
}

$username = $_SESSION['username'];

// Get course details from URL parameters
if (isset($_GET['course_id']) && isset($_GET['price'])) {
    $course_id = $_GET['course_id'];
    $price = $_GET['price'];
} else {
    echo "Invalid course selection.";
    exit();
}

// Fetch course data (optional if needed)
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();

if (!$course) {
    echo "Course not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Enrollment</title>
</head>
<body>
    <h1>Enroll in <?php echo htmlspecialchars($course['course_name']); ?></h1>
    <form method="POST" action="enroll.php">
    <p>Price: ₹<?php echo htmlspecialchars($price); ?></p>

    <form method="POST" action="enroll.php">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        <button type="submit">Confirm Enrollment</button>
    </form>
</body>
</html>
