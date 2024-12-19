
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
  <link rel="stylesheet" href="css/profile_styles.css">
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
  <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="../assets/uploads/<?php echo htmlspecialchars($photo); ?>" alt="avatar" class="rounded-circle img-fluid">
                            <h5 class="my-3" id= "firstname"><?php echo htmlspecialchars($student['firstname']); ?></h5>
                            <p  class="text-muted mb-1">Full Stack Developer</p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                            <div>
                                <button class="btn btn-primary">Source</button>
                                <a href="edit_profile.php">
                                    <button class="btn btn-outline-primary">Edit Profile</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">https://mdbootstrap.com</p>
                                </li>
                                <li class="list-group-item">
                                    <i class="fab fa-github fa-lg text-body"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo htmlspecialchars($student['firstname']); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">example@example.com</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">(097) 234-5678</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">(098) 765-4321</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic">Course</span> Status</p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 80%;"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Full Stack Development</p>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 72%;"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Linux</p>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 89%;"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 66%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function settings()
            {
                document.getElementById("settings").style.display="block";
                document.getElementById('dashboard').style.display="none";
                document.getElementById('project').style.display="none";
                document.getElementById('compiler').style.display="none";
                document.getElementById('course').style.display="none";
            }
            function previewAvatar(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                    const output = document.getElementById('avatarPreview');
                    output.src = reader.result;
                };
                    reader.readAsDataURL(event.target.files[0]);
                }
    </script>
    <script src="../course/js/script.js"></script>
    <script src="assets/js/main.js"></script>
  
</body>
</html>

