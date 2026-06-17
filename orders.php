<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Added products.image
$query = "
SELECT orders.id AS order_id, orders.total, orders.address, orders.created_at,
       products.name, products.price, products.image, order_items.quantity
FROM orders
JOIN order_items ON orders.id = order_items.order_id
JOIN products ON order_items.product_id = products.id
WHERE orders.user_id = $user_id
ORDER BY orders.id DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>

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

/* Container */
.container {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(auto-fill, 250px);
    justify-content: center;
    gap: 20px;
}

/* Card */
.card {
    width: 250px;
    background: #1e293b;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    text-align: center;
}

/* Image */
.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

/* Price */
.price {
    color: #38bdf8;
    font-weight: bold;
}

/* Address */
.address {
    font-size: 13px;
    margin-top: 8px;
    color: #cbd5f5;
}

/* Top bar */
.top-bar {
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
}

a {
    color: #38bdf8;
    text-decoration: none;
    font-weight: bold;
}
</style>

</head>
<body>

<div class="header">
    <h2>📦 My Orders</h2>
</div>

<div class="top-bar">
    <a href="index.php">⬅ Back to Products</a>
</div>

<div class="container">

<?php if($result->num_rows > 0){ ?>

<?php while($row = $result->fetch_assoc()){ ?>

    <div class="card">

        <!-- ✅ IMAGE ADDED -->
        <img src="images/<?php echo $row['image']; ?>" alt="product">

        <h3><?php echo $row['name']; ?></h3>

        <p class="price">₹<?php echo $row['price']; ?></p>

        <p>Quantity: <?php echo $row['quantity']; ?></p>

        <p><strong>Order ID:</strong> <?php echo $row['order_id']; ?></p>

        <p class="address">
            <strong>Address:</strong><br>
            <?php echo $row['address']; ?>
        </p>

    </div>

<?php } ?>

<?php } else { ?>

    <p style="text-align:center;">No orders found</p>

<?php } ?>

</div>

</body>
</html>