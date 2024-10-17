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

if (isset($_POST['submit'])) {
    // File data
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

    // Read the file content
    $fileContent = addslashes(file_get_contents($fileTmpName));

    // Insert file metadata and content into database
    $sql = "INSERT INTO users (name, type, size, content) VALUES ('$fileName', '$fileType', '$fileSize', '$fileContent')";

    if ($conn->query($sql) === TRUE) {
        echo "File uploaded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!-- HTML form to upload file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>



