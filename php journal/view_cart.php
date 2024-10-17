<?php
$host = "localhost";
$dbname = "shoping";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart items with product details
$sql = "SELECT cart.id, products.name, products.price, cart.quantity
        FROM cart
        INNER JOIN products ON cart.product_id = products.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php
        $grand_total = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total = $row['price'] * $row['quantity'];
                $grand_total += $total;

                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>$" . $row['price'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>$" . $total . "</td>";
                echo "<td><a href='remove_from_cart.php?id=" . $row['id'] . "'>Remove</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Your cart is empty!</td></tr>";
        }
        ?>

        <tr>
            <td colspan="3" align="right"><strong>Grand Total:</strong></td>
            <td><strong>$<?php echo $grand_total; ?></strong></td>
            <td></td>
        </tr>
    </table>

    <p><a href="index.php">Continue Shopping</a></p>
</body>
</html>

<?php
$conn->close();
?>
