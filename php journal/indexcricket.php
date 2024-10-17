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

// Initialize variables
$id = $name = $country = $no_of_matches = $no_of_runs = "";
$update = false;

// Insert or Update cricketer data
if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $country = $_POST['Country'];
    $no_of_matches = $_POST['No_Of_Matches'];
    $no_of_runs = $_POST['No_Of_Runs'];

    // Input validation
    if (!empty($name) && !empty($country) && !empty($no_of_matches) && !empty($no_of_runs)) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update record
            $id = $_POST['id'];
            $sql = "UPDATE playerInfo SET Name='$name', Country='$country', No_Of_Matches='$no_of_matches', No_Of_Runs='$no_of_runs' WHERE id=$id";
        } else {
            // Insert new record
            $sql = "INSERT INTO playerInfo (Name, Country, No_Of_Matches, No_Of_Runs) VALUES ('$name', '$country', '$no_of_matches', '$no_of_runs')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Record saved successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required!";
    }
}

// Fetch record to edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM playerInfo WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $country = $row['Country'];
        $no_of_matches = $row['No_Of_Matches'];
        $no_of_runs = $row['No_Of_Runs'];
        $update = true;
    }
}

// Delete player
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM playerInfo WHERE id=$id");
    echo "Record deleted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricketer Information Management</title>
</head>
<body>
    <h1>Cricketer Information</h1>

    <!-- Cricketer Form -->
    <form action="indexcricket.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div>
            <label for="Name">Player Name:</label>
            <input type="text" name="Name" value="<?php echo $name; ?>" required>
        </div>
        <div>
            <label for="Country">Country:</label>
            <input type="text" name="Country" value="<?php echo $country; ?>" required>
        </div>
        <div>
            <label for="No_Of_Matches">No of Matches:</label>
            <input type="number" name="No_Of_Matches" value="<?php echo $no_of_matches; ?>" required>
        </div>
        <div>
            <label for="No_Of_Runs">No of Runs:</label>
            <input type="number" name="No_Of_Runs" value="<?php echo $no_of_runs; ?>" required>
        </div>
        <div>
            <button type="submit" name="submit"><?php echo $update ? 'Update' : 'Add'; ?> Cricketer</button>
        </div>
    </form>

    <!-- Player List by Country -->
    <h2>Player Information by Country</h2>
    <?php
    // Fetch players grouped by country
    $result = $conn->query("SELECT Country, GROUP_CONCAT(Name SEPARATOR ', ') AS Players FROM playerInfo GROUP BY Country");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h3>Country: " . $row['Country'] . "</h3>";
            echo "<p>Players: " . $row['Players'] . "</p>";
        }
    } else {
        echo "<p>No players found!</p>";
    }
    ?>

    <!-- Player List with Edit/Delete Options -->
    <h2>All Players</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Country</th>
            <th>No of Matches</th>
            <th>No of Runs</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM playerInfo");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Country'] . "</td>";
                echo "<td>" . $row['No_Of_Matches'] . "</td>";
                echo "<td>" . $row['No_Of_Runs'] . "</td>";
                echo "<td><a href='indexcricket.php?edit=" . $row['id'] . "'>Edit</a> | <a href='indexcricket.php?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found!</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
