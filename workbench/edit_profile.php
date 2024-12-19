
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
  <link rel="stylesheet" href="css/edit-style.css">
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <title>Profile</title>
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
  </header>
  <br>
  <section class="settings-section" id="settings">
        <h1 style="font-size:30px;">SETTINGS</h1>
        <?php
                // Fetch student data from the database
                $stmt = $conn->prepare("SELECT firstname, lastname, username, phone_number, dob, address, institution, photo FROM students WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $student = $result->fetch_assoc();
                if (!$student) {
                    echo "Error fetching student data.";
                    exit();
                }
                $fullname = $student['username'];
                $photo = $student['photo'];
                ?>
                <div class="settings-container">
                    
                    <div class="profile-photo">
                        <img src="../assets/uploads/<?php echo htmlspecialchars($photo); ?>" alt="Profile Photo">
                    </div>
                    <form action="../assets/update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($student['firstname']); ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($student['lastname']); ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($student['phone_number']); ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($student['dob']); ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" required><?php echo htmlspecialchars($student['address']); ?></textarea>
                        </div>
                        <div class="input-group">
                            <label for="institution">Institution</label>
                            <input type="text" id="institution" name="institution" value="<?php echo htmlspecialchars($student['institution']); ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="photo">Change Photo</label>
                            <input type="file" id="photo" name="photo">
                        </div>
                        <div class="input-group">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="input-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password">
                        </div>
                        <center>
                             <button type="submit" class="update-btn">Update Profile</button>
                        </center>
                    </form>
                </div>
            <?php 
                $stmt->close();
                $conn->close();
            ?>
        </section>
  
</body>
</html>

