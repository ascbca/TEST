<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname   = "shoping";


// Create connection
$conn = mysqli_connect($servername , $username  , $password , $dbname );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>$" . $row['price'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td><a href='add_to_cart.php?id=" . $row['id'] . "'>Add to Cart</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No products found!</td></tr>";
        }
        ?>
    </table>

    <p><a href="view_cart.php">View Cart</a></p>
</body>
</html>

<?php
$conn->close();
?>
