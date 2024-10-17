<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname   = "pjs";


// Create connection
$conn = mysqli_connect($servername , $username  , $password , $dbname );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['file_id'])) {
    $fileId = $_GET['file_id'];

    // Fetch file data from database
    $sql = "SELECT * FROM users WHERE id = $fileId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $file = $result->fetch_assoc();
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileContent = $file['content'];

        // Set headers to download file
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: $fileType");

        echo $fileContent;
    } else {
        echo "File not found!";
    }
}

$conn->close();
?>
