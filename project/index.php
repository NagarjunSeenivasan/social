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

$sql = "SELECT * FROM uploaded_files ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Projects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            margin: 0;
        }
        h1 {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #333;
        }
        .download-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 300px;
            text-align: center;
            margin: 10px;
        }
        .card-header {
            background-size: cover;
            background-position: center;
            height: 150px;
        }
        .card-body {
            padding: 20px;
        }
        .card-body img {
            width: 50px;
            margin-bottom: 10px;
        }
        .card-body h3 {
            margin: 10px 0 5px;
            font-size: 1.2em;
        }
        .card-body p {
            color: #666;
            margin: 5px 0 20px;
            font-size: 0.9em;
        }
        .download-btn {
            background-color: #5cb85c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .download-btn:hover {
            background-color: #4cae4c;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .download-card {
                max-width: 45%;
            }
        }

        @media (max-width: 480px) {
            .download-card {
                max-width: 100%;
            }
            h1 {
                font-size: 1.5em;
            }
            .card-body h3 {
                font-size: 1em;
            }
            .card-body p {
                font-size: 0.8em;
            }
            .download-btn {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

<h1>Sample Projects</h1>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $file_name = $row['file_name'];
        $file_path = $row['file_path'];
        $background_img = $row['background_img_path'];
        ?>

        <div class="download-card">
            <div class="card-header" style="background-image: url('<?php echo $background_img; ?>');"></div>
            <div class="card-body">
                <img src="img/logo.png" alt="cadibel">
                <h3><?php echo $file_name; ?></h3>
                <br>
                <a href="<?php echo $file_path; ?>" class="download-btn" download>Download</a>
            </div>
        </div>

        <?php
    }
} else {
    echo "No files found.";
}

$conn->close();
?>

</body>
</html>
