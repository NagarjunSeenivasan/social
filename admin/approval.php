<?php
// session_start();
// include '../assets/connect.php';

// $request_id = $_POST['request_id'];

// // Fetch the enrollment ID
// $stmt = $conn->prepare("
//     SELECT enrollment_id FROM admin_requests WHERE id = ?
// ");
// $stmt->bind_param("i", $request_id);
// $stmt->execute();
// $result = $stmt->get_result();
// $request = $result->fetch_assoc();
// $enrollment_id = $request['enrollment_id'];

// // Approve the enrollment
// $update_stmt = $conn->prepare("
//     UPDATE enrollments SET status = 'approved' WHERE id = ?
// ");
// $update_stmt->bind_param("i", $enrollment_id);
// $update_stmt->execute();

// // Delete the admin request after approval
// $delete_stmt = $conn->prepare("DELETE FROM admin_requests WHERE id = ?");
// $delete_stmt->bind_param("i", $request_id);
// $delete_stmt->execute();

// $stmt->close();
// $update_stmt->close();
// $delete_stmt->close();
// $conn->close();

// // Redirect back to admin page
// header("Location: admin-dashboard.php");
// exit();
?>


<?php
session_start();
include '../assets/connect.php';

if (!isset($_POST['request_id']) || !isset($_POST['action'])) {
    header("Location: admin-dashboard.php");
    exit();
}

$request_id = $_POST['request_id'];
$action = $_POST['action'];

// Fetch the corresponding enrollment ID
$stmt = $conn->prepare("SELECT enrollment_id FROM admin_requests WHERE id = ?");
$stmt->bind_param("i", $request_id);
$stmt->execute();
$stmt->bind_result($enrollment_id);
$stmt->fetch();
$stmt->close();

if ($action === 'approve') {
    // Approve the enrollment request
    $update_stmt = $conn->prepare("UPDATE enrollments SET status = 'approved' WHERE id = ?");
    $update_stmt->bind_param("i", $enrollment_id);
    $update_stmt->execute();
    $update_stmt->close();
} elseif ($action === 'reject') {
    // Reject (delete) the enrollment request
    $delete_stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
    $delete_stmt->bind_param("i", $enrollment_id);
    $delete_stmt->execute();
    $delete_stmt->close();
}

// Delete the admin request after handling
$delete_request_stmt = $conn->prepare("DELETE FROM admin_requests WHERE id = ?");
$delete_request_stmt->bind_param("i", $request_id);
$delete_request_stmt->execute();
$delete_request_stmt->close();

$conn->close();

// Redirect back to the admin dashboard
header("Location: admin-dashboard.php");
exit();
?>
