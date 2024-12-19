<?php
session_start();
include '../assets/connect.php';  // Adjust the path as needed

// Capture search query if present
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch files, with or without search
if (!empty($searchQuery)) {
    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM uploaded_files WHERE file_name LIKE ? ORDER BY uploaded_at DESC");
    $searchParam = '%' . $searchQuery . '%';  // Add wildcards for partial match
    $stmt->bind_param("s", $searchParam);
} else {
    // If no search, fetch all files
    $stmt = $conn->prepare("SELECT * FROM uploaded_files ORDER BY uploaded_at DESC");
}

$stmt->execute();
$result_p = $stmt->get_result();

if (!isset($_SESSION['username'])) {
    header("Location: ../student/index.php");  // Redirect to login if session not found
    exit();
}
$username = $_SESSION['username'];

// Fetch student data from the database
$stmt_student = $conn->prepare("SELECT username, photo FROM students WHERE username = ?");
$stmt_student->bind_param("s", $username);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
$student = $result_student->fetch_assoc();

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
  <link rel="stylesheet" href="css/project-styles.css">
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <title>Project</title>
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
  <form method="GET" action="project.php">
    <label for="search">Search</label>
    <input id="search" name="search" type="search" pattern=".*\S.*" value="<?php echo htmlspecialchars($searchQuery); ?>" required>
    <span class="caret"></span>
</form>

<section id="project" class="container">
    <?php
        if ($result_p->num_rows > 0) {
            while($row = $result_p->fetch_assoc()) {
                $file_name = $row['file_name'];
                $file_path = $row['file_path'];
                $background_img = $row['background_img_path'];
                ?>

                <div class="card">
                    <div class="card-img" style="background-image: url('../project/<?php echo $background_img; ?>');"></div>
                    <div class="card-content">
                        <img src="img/logo.png" alt="cadibel Logo">
                        <h3><?php echo $file_name; ?></h3>
                        <br>
                        <a href="../project/<?php echo $file_path; ?>" class="download-btn" download>Download</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "No files found.";
        }
    ?>
</section>

        <script>
             function project()
            {
                document.getElementById("project").style.display="block";
                document.getElementById('dashboard').style.display="none";
                document.getElementById('compiler').style.display="none";
                document.getElementById('course').style.display="none";
                document.getElementById('settings').style.display="none";
            }
        </script>
        <script src="../course/js/script.js"></script>
        <script src="assets/js/main.js"></script>
</body>
</html>

