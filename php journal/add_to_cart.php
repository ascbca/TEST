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

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if product is already in the cart
    $sql = "SELECT * FROM cart WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If product is already in the cart, increase the quantity
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $product_id";
    } else {
        // If product is not in the cart, insert it
        $sql = "INSERT INTO cart (product_id, quantity) VALUES ($product_id, 1)";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<p><a href="index.php">Continue Shopping</a></p>
<p><a href="view_cart.php">View Cart</a></p>
