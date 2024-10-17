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

// Fetch files from database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Files</title>
</head>
<body>
    <h1>Uploaded Files</h1>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='download.php?file_id=" . $row['id'] . "'>" . $row['name'] . "</a></li>";
            }
        } else {
            echo "<li>No files found!</li>";
        }
        ?>
    </ul>
</body>
</html>

<?php
$conn->close();
?>
