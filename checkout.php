<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get cart items
$query = "
SELECT cart.product_id, products.price, cart.quantity 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id = $user_id
";

$result = $conn->query($query);

$total = 0;
$items = [];

while($row = $result->fetch_assoc()){
    $items[] = $row;
    $total += $row['price'] * $row['quantity'];
}

// Handle order
$message = "";
$showAddress = "";

if(isset($_POST['place_order'])){
    $address = $_POST['address'];

    // Insert order
    $conn->query("INSERT INTO orders (user_id, total, address) VALUES ($user_id, $total, '$address')");
    $order_id = $conn->insert_id;

    // Insert order items
    foreach($items as $item){
        $pid = $item['product_id'];
        $qty = $item['quantity'];

        $conn->query("INSERT INTO order_items (order_id, product_id, quantity) VALUES ($order_id, $pid, $qty)");
    }

    // Clear cart
    $conn->query("DELETE FROM cart WHERE user_id = $user_id");

    // Success message
    $message = "✅ Order Placed Successfully!";
    $showAddress = $address;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<style>
body {
    font-family: Arial;
    background: #0f172a;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Box */
.box {
    background: #1e293b;
    padding: 30px;
    border-radius: 10px;
    width: 350px;
    text-align: center;
}

/* Input */
textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 6px;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: green;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: darkgreen;
}

/* Success */
.success {
    margin-top: 15px;
    background: #022c22;
    padding: 10px;
    border-radius: 6px;
}
</style>

</head>
<body>

<div class="box">

    <h2>Checkout</h2>

    <p>Total Amount: ₹<?php echo $total; ?></p>

<?php if($message == ""){ ?>

    <!-- SHOW FORM ONLY BEFORE ORDER -->
    <form method="post">
        <textarea name="address" placeholder="Enter Delivery Address" required></textarea>
        <button name="place_order">Place Order</button>
    </form>

<?php } else { ?>

    <!-- SHOW SUCCESS MESSAGE AFTER ORDER -->
    <div class="success">
        <p><?php echo $message; ?></p>
        <p><strong>Delivery Address:</strong></p>
        <p><?php echo $showAddress; ?></p>

        <!-- 🔙 BACK BUTTON -->
        <a href="index.php">
            <button style="margin-top:10px; background:#2193b0;">
                Back to Home
            </button>
        </a>
    </div>

<?php } ?>

</div>

</body>
</html>