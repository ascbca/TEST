<?php
$host = "localhost";
$dbname = "emp";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$EmpNo = $EmpName = $Salary = $DeptName = $DOJ = "";
$update = false;

// Insert or Update employee data
if (isset($_POST['submit'])) {
    $EmpName = $_POST['EmpName'];
    $Salary = $_POST['Salary'];
    $DeptName = $_POST['DeptName'];
    $DOJ = $_POST['DOJ'];

    if (isset($_POST['EmpNo']) && !empty($_POST['EmpNo'])) {
        // Update record
        $EmpNo = $_POST['EmpNo'];
        $sql = "UPDATE tblEmp SET EmpName='$EmpName', Salary='$Salary', DeptName='$DeptName', DOJ='$DOJ' WHERE EmpNo=$EmpNo";
    } else {
        // Insert new record
        $sql = "INSERT INTO tblEmp (EmpName, Salary, DeptName, DOJ) VALUES ('$EmpName', '$Salary', '$DeptName', '$DOJ')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch record to edit
if (isset($_GET['edit'])) {
    $EmpNo = $_GET['edit'];
    $result = $conn->query("SELECT * FROM tblEmp WHERE EmpNo=$EmpNo");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $EmpName = $row['EmpName'];
        $Salary = $row['Salary'];
        $DeptName = $row['DeptName'];
        $DOJ = $row['DOJ'];
        $update = true;
    }
}

// Delete employee
if (isset($_GET['delete'])) {
    $EmpNo = $_GET['delete'];
    $conn->query("DELETE FROM tblEmp WHERE EmpNo=$EmpNo");
    echo "Record deleted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>
<body>
    <h1>Employee Information</h1>

    <!-- Employee Form -->
    <form action="indexemp.php" method="POST">
        <input type="hidden" name="EmpNo" value="<?php echo $EmpNo; ?>">
        <div>
            <label for="EmpName">Employee Name:</label>
            <input type="text" name="EmpName" value="<?php echo $EmpName; ?>" required>
        </div>
        <div>
            <label for="Salary">Salary:</label>
            <input type="number" name="Salary" value="<?php echo $Salary; ?>" required>
        </div>
        <div>
            <label for="DeptName">Department Name:</label>
            <input type="text" name="DeptName" value="<?php echo $DeptName; ?>" required>
        </div>
        <div>
            <label for="DOJ">Date of Joining (DOJ):</label>
            <input type="date" name="DOJ" value="<?php echo $DOJ; ?>" required>
        </div>
        <div>
            <button type="submit" name="submit"><?php echo $update ? 'Update' : 'Add'; ?> Employee</button>
        </div>
    </form>

    <!-- Employee List -->
    <h2>All Employees</h2>
    <table border="1">
        <tr>
            <th>Employee No</th>
            <th>Employee Name</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Date of Joining</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM tblEmp");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['EmpNo'] . "</td>";
                echo "<td>" . $row['EmpName'] . "</td>";
                echo "<td>" . $row['Salary'] . "</td>";
                echo "<td>" . $row['DeptName'] . "</td>";
                echo "<td>" . $row['DOJ'] . "</td>";
                echo "<td><a href='indexemp.php?edit=" . $row['EmpNo'] . "'>Edit</a> | <a href='indexemp.php?delete=" . $row['EmpNo'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
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
