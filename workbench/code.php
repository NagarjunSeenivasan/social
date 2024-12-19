
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
  <link rel="stylesheet" href="css/code-styles.css">
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

  <section class="compiler" id="compiler">
        <iframe
        frameBorder="0"
        height="700px"  
        src="https://onecompiler.com/embed/" 
        width="100%"
        ></iframe>
        </section>
        <script>
        window.onmessage = function (e) {
            if (e.data && e.data.action) {
                console.log(e.data);
                // handle the e.data which contains following
                // action (ex. challengeFinished), challengeId & userId)
            }
        };
</script>
        <script src="../course/js/script.js"></script>
        <script src="assets/js/main.js"></script>

</body>
</html>

