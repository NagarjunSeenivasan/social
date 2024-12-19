<?php
session_start();
include '../assets/connect.php';  // Adjust the path as needed

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

// Handle search query
$searchQuery = '';
$minSearchLength = 3;  // Set minimum search length

if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);  // Get the search query
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/course-style.css">
  <title>Course</title>
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
  </header><br>

  <form method="GET" action="course.php">
    <label for="search">Search</label>
    <input id="search" name="search" type="search" pattern=".*\S.*" value="<?php echo htmlspecialchars($searchQuery); ?>" required>
    <span class="caret"></span>
</form>

  <section id="course" class="courses-section">
    <div class="course-container">
      <?php
      // Only perform the search if the search query is at least $minSearchLength characters
      if (strlen($searchQuery) >= $minSearchLength) {
          $stmt = $conn->prepare("SELECT * FROM courses WHERE course_name LIKE ? OR description LIKE ?");
          $searchParam = "%$searchQuery%";
          $stmt->bind_param("ss", $searchParam, $searchParam);
      } else {
          // If the search query is too short or empty, fetch all courses
          $stmt = $conn->prepare("SELECT * FROM courses");
      }

      $stmt->execute();
      $courses = $stmt->get_result();

      if ($courses->num_rows > 0) {
          while ($course = $courses->fetch_assoc()) {
              // Check if the user has already enrolled in the course
              $stmtEnroll = $conn->prepare("SELECT * FROM enrollments WHERE course_id = ? AND student_username = ?");
              $stmtEnroll->bind_param("is", $course['id'], $username);
              $stmtEnroll->execute();
              $resultEnroll = $stmtEnroll->get_result();
              $already_enrolled = $resultEnroll->num_rows > 0;
              ?>
              <div class="course-card">
                  <img src="../assets/uploads/<?php echo htmlspecialchars($course['course_image']); ?>" alt="course-image">
                  <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
                  <p><?php echo htmlspecialchars($course['description']); ?></p>
                  <p>Price: ₹<?php echo htmlspecialchars($course['price']); ?></p>

                  <?php if ($already_enrolled) { ?>
                      <p style="color: red;">You have already enrolled in this course.</p>
                  <?php } else { ?>
                      <form method="POST" action="../assets/enroll.php">
                          <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                          <button type="submit" class="enroll-btn">Enroll</button>
                      </form>
                  <?php } ?>
              </div>
              <?php
          }
      } else {
          echo "<p>No courses found.</p>";
      }
      ?>
    </div>
  </section>
</body>
</html>
