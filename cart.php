<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT cart.id, products.name, products.price, cart.quantity 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id = $user_id
";

$result = $conn->query($query);

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Cart</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #0f172a;
    color: white;
}

/* Header */
.header {
    background: #020617;
    padding: 15px;
    text-align: center;
}

/* Top bar */
.top-bar {
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
}

/* Links */
a {
    color: #38bdf8;
    text-decoration: none;
    font-weight: bold;
}

/* Container */
.container {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

/* Card */
.card {
    background: #1e293b;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    transition: 0.3s;
}

.card:hover {
    transform: scale(1.03);
}

/* Price */
.price {
    color: #38bdf8;
    font-weight: bold;
}

/* Remove Button */
.remove-btn {
    margin-top: 10px;
    background: #ef4444;
    color: white;
    padding: 8px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.remove-btn:hover {
    background: #dc2626;
}

/* Total Box */
.total-box {
    margin: 20px;
    padding: 20px;
    background: #020617;
    border-radius: 10px;
    text-align: center;
    font-size: 18px;
}
</style>

</head>
<body>

<div class="header">
    <h2>🛒 Your Cart</h2>
</div>

<div class="top-bar">
    <a href="index.php">⬅ Back to Products</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">

<?php while($row = $result->fetch_assoc()){ 
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
?>

    <div class="card">
        <h3><?php echo $row['name']; ?></h3>

        <p class="price">Price: ₹<?php echo $row['price']; ?></p>

        <p>Quantity: <?php echo $row['quantity']; ?></p>

        <p>Subtotal: ₹<?php echo $subtotal; ?></p>

        <!-- REMOVE BUTTON -->
        <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>">
            <button class="remove-btn">Remove</button>
        </a>
    </div>

<?php } ?>

</div>

<div class="total-box">
    <h3>Total Amount: ₹<?php echo $total; ?></h3>
</div>
<div style="text-align:center; margin-bottom:20px;">
    <a href="checkout.php">
        <button style="padding:12px 20px; background:green; color:white; border:none; border-radius:6px; cursor:pointer;">
            Buy Now
        </button>
    </a>
</div>
</body>
</html>