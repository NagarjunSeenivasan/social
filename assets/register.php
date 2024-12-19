<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $created_at = date('Y-m-d H:i:s');

    // File upload handling
    $target_dir = "uploads/";
    $image_name = basename($_FILES["course_image"]["name"]); // Extract image name
    $target_file = $target_dir . $image_name;
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES["course_image"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    // Check file size (example: limit to 2MB)
    if ($_FILES["course_image"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["course_image"]["tmp_name"], $target_file)) {
            // Save only the image name in the database
            $sql = "INSERT INTO courses (course_name, description, course_image, created_at) 
                    VALUES ('$course_name', '$description', '$image_name', '$created_at')";

            if (mysqli_query($conn, $sql)) {
                echo "Course registered successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
