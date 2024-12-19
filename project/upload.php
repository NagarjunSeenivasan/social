<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadibel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    
    // Handling the project file upload
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;

    // Handling the background image upload
    $background_img_name = basename($_FILES["backgroundImg"]["name"]);
    $background_img_target = $target_dir . $background_img_name;

    // Check if file already exists
    if (file_exists($target_file) || file_exists($background_img_target)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 50MB)
    if ($_FILES["fileToUpload"]["size"] > 50000000 || $_FILES["backgroundImg"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $imgFileType = strtolower(pathinfo($background_img_target, PATHINFO_EXTENSION));
    
    if($fileType != "zip") {
        echo "Sorry, only ZIP files are allowed.";
        $uploadOk = 0;
    }
    
    if(!in_array($imgFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for background images.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Upload files
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["backgroundImg"]["tmp_name"], $background_img_target)) {
            echo "The files have been uploaded.";

            // Insert file info into database
            $sql = "INSERT INTO uploaded_files (file_name, file_path, background_img_path) VALUES ('$file_name', '$target_file', '$background_img_target')";
            if ($conn->query($sql) === TRUE) {
                echo "File information stored successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your files.";
        }
    }
}

$conn->close();
?>
