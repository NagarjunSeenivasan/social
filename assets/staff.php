<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $address = $conn->real_escape_string($_POST['address']);
    $institution = $conn->real_escape_string($_POST['institution']);
    $aadhar_number = $conn->real_escape_string($_POST['aadhar_number']);
    $account_number = $conn->real_escape_string($_POST['account_number']);
    $account_holder_name = $conn->real_escape_string($_POST['account_holder_name']);
    $ifsc_code = $conn->real_escape_string($_POST['ifsc_code']);
    $branch_name = $conn->real_escape_string($_POST['branch_name']);
    $bank_name = $conn->real_escape_string($_POST['bank_name']);

    // Handle file upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        // Insert data into staff table
        $stmt = $conn->prepare("INSERT INTO staff (firstname, lastname, username, password, dob, phone_number, photo, address, institution, aadhar_number, account_number, account_holder_name, ifsc_code, branch_name, bank_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssss", $firstname, $lastname, $username, $password, $dob, $phone_number, $target_file, $address, $institution, $aadhar_number, $account_number, $account_holder_name, $ifsc_code, $branch_name, $bank_name);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
