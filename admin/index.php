<?php
session_start();
include '../assets/connect.php';  // Connect to the database

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../login.php");  // Redirect to login page
    exit();
}

// Fetch courses and their enrollments
$courses = $conn->query("SELECT * FROM courses");
$enrollments = $conn->query("
    SELECT enrollments.course_id, students.username, students.fullname, courses.course_name, enrollments.price
    FROM enrollments
    JOIN students ON enrollments.student_username = students.username
    JOIN courses ON enrollments.course_id = courses.id
");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin-style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    <section>
        <h2>Courses</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($course = $courses->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $course['id']; ?></td>
                        <td><?php echo $course['course_name']; ?></td>
                        <td><?php echo $course['description']; ?></td>
                        <td>₹<?php echo $course['price']; ?></td>
                        <td>
                            <a href="edit_course.php?id=<?php echo $course['id']; ?>">Edit</a> | 
                            <a href="delete_course.php?id=<?php echo $course['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Enrollments</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Student Username</th>
                    <th>Student Full Name</th>
                    <th>Price Paid</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($enrollment = $enrollments->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $enrollment['course_name']; ?></td>
                        <td><?php echo $enrollment['username']; ?></td>
                        <td><?php echo $enrollment['fullname']; ?></td>
                        <td>₹<?php echo $enrollment['price']; ?></td>
                        <td>
                            <a href="delete_enrollment.php?course_id=<?php echo $enrollment['course_id']; ?>&username=<?php echo $enrollment['username']; ?>">Remove Enrollment</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
