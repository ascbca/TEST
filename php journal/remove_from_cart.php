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

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];

    // Delete item from the cart
    $sql = "DELETE FROM cart WHERE id = $cart_id";

    if ($conn->query($sql) === TRUE) {
        echo "Item removed from cart!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<p><a href="view_cart.php">View Cart</a></p>
<p><a href="index.php">Continue Shopping</a></p>
