
<?php
session_start();
include '../assets/connect.php';

// Fetch all pending requests
$requests = $conn->query("
    SELECT admin_requests.id, students.firstname, students.lastname, courses.course_name 
    FROM admin_requests
    JOIN enrollments ON admin_requests.enrollment_id = enrollments.id
    JOIN students ON enrollments.student_username = students.username
    JOIN courses ON enrollments.course_id = courses.id
    WHERE enrollments.status = 'pending'
");

while ($request = $requests->fetch_assoc()) {
?>
<div class="request">
    <p><?php echo htmlspecialchars($request['firstname'] . ' ' . $request['lastname']); ?> requested to enroll in <?php echo htmlspecialchars($request['course_name']); ?></p>
    <form method="POST" action="approval.php" style="display: inline;">
        <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
        <button type="submit" name="action" value="approve">Approve</button>
        <button type="submit" name="action" value="reject" style="background-color: red; color: white;">Reject</button>
    </form>
</div>
<?php
}
$conn->close();
?>
