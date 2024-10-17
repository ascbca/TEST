<?php
$host = "localhost";
$dbname = "cricket";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['query'])) {
    $search = $_POST['query'];

    // Search query to find matching cricketers
    $stmt = $conn->prepare("SELECT Name FROM playerInfo WHERE Name LIKE ?");
    $likeSearch = "%$search%";
    $stmt->bind_param("s", $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>" . $row['Name'] . "</div>";
        }
    } else {
        echo "<div>No results found</div>";
    }

    $stmt->close();
}

$conn->close();
?>
