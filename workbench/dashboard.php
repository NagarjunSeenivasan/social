
<?php
    session_start();
    include '../assets/connect.php';  // Adjust the path as needed
    $sql = "SELECT * FROM uploaded_files ORDER BY uploaded_at DESC";
    $result_p = $conn->query($sql);
    if (!isset($_SESSION['username'])) {
        header("Location: ../student/index.php");  // Redirect to login if session not found
        exit();
    }
    $username = $_SESSION['username'];
    // Fetch student data from the database
    $stmt = $conn->prepare("SELECT username, photo FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        $fullname = $student['username'];
        $photo = $student['photo'];
    } else {
        echo "Error fetching student data.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/dashboard-styles.css">
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <title>WorkBench</title>
</head>
<body>
  <header>
  <section class="window">
    <ul class="menu-bar">
        <!-- Left side logo -->
        <div>
            <figure class="logo">
                <img src="img/h-logo.png" alt="logo" width="60px">
            </figure> 
        </div>
        
        <!-- Left side menu items -->
        <div class="menu-left">
            <li class="menu-item">
                <a class="fas fa-suitcase">Select</a>
                <!-- Subnavigation for Work menu -->
                <ul class="submenu">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Assignment</a></li>
                    <li><a href="code.php">Code</a></li>
                </ul>
            </li>
            <a href="course.php"><li class="fas fa-suitcase">Course</li></a>
            <a href="project.php"><li class="fas fa-suitcase">Project</li></a>
            <a href="profile.php"><li class="fas fa-suitcase">Profile</li></a>
        </div>
        
        <!-- Right side profile photo and name -->
        <div class="pa">
            <img src="../assets/uploads/<?php echo htmlspecialchars($photo); ?>" alt="profile">
            <p><?php echo htmlspecialchars($fullname); ?>&nbsp;<span style="font-size:20px;">!</span></p>
        </div>
    </ul>
</section>
  </header><br><br>

  <section class="dashboard" id="dashboard">
           
            <div class="course-container-dashboard">
            <?php
                $query = "
                SELECT courses.course_name, courses.description, courses.course_image 
                FROM enrollments
                JOIN courses ON enrollments.course_id = courses.id
                WHERE enrollments.student_username = ? AND enrollments.status = 'approved'
                ";

                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($course = $result->fetch_assoc()) {
                        ?>
                        <div class="course-card-dashboard">
                            <img src="../assets/uploads/<?php echo htmlspecialchars($course['course_image']); ?>" alt="course-image" width="200px" style="border-radius:10px;">
                            <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
                            <p><?php echo htmlspecialchars($course['description']); ?></p>
                            <br>
                            <a href="" class="continue-btn">Continue</a>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No approved courses found.</p>";
                }
            ?>
            </div>
        </section>
        <script>
             function dashboard()
            {
                document.getElementById("dashboard").style.display="block";
                document.getElementById('project').style.display="none";
                document.getElementById('compiler').style.display="none";
                document.getElementById('course').style.display="none";
                document.getElementById('settings').style.display="none";
            }
        </script>
        <script src="../course/js/script.js"></script>
        <script src="assets/js/main.js"></script>

</body>
</html>

