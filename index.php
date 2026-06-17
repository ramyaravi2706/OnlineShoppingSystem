<?php
session_start();
include 'db.php';

// 🔐 protect page
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $result = $conn->query("SELECT * FROM products WHERE name LIKE '%$search%'");
} else {
    $result = $conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Products</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #f4f6f9;
}

/* Header */
.header {
    background: #2193b0;
    color: white;
    padding: 15px;
    text-align: center;
}

/* Grid Layout */
.container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

/* Product Card */
.card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
    transition: 0.3s;
    width: 250px;
}

.card:hover {
    transform: translateY(-5px);
}

/* Image */
.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

/* Title */
.card h3 {
    margin: 10px 0;
}

/* Description */
.desc {
    font-size: 14px;
    color: gray;
}

/* Price */
.price {
    color: green;
    font-weight: bold;
    margin: 10px 0;
}

/* Button */
.btn {
    padding: 10px;
    background: #2193b0;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.search-box input {
    padding: 10px;
    width: 250px;
    border-radius: 6px;
    border: none;
}

.search-box button {
    padding: 10px;
    background: #2193b0;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.btn:hover {
    background: #176d85;
}

/* Top Links */
.top-bar {
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
}

a {
    text-decoration: none;
    color: #2193b0;
    font-weight: bold;
}
</style>

</head>
<body>

<div class="header">
    <h2>🛒 Online Shop</h2>
</div>

<div class="top-bar">
    <a href="cart.php">🛒 Cart</a>
    
    <div>
        <a href="orders.php" style="margin-right:15px;">📦 My Orders</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
<div style="text-align:center; margin:20px;">
    <form method="GET">
        <input type="text" name="search" placeholder="Search products..." 
               value="<?php echo $search; ?>"
               style="padding:10px; width:250px; border-radius:6px; border:1px solid #ccc;">
        
        <button type="submit" 
                style="padding:10px; background:#2193b0; color:white; border:none; border-radius:6px;">
            Search
        </button>
    </form>
</div>

<div class="container">

<?php while($row = $result->fetch_assoc()){ ?>
    
    <div class="card">
        <img src="images/<?php echo $row['image']; ?>" alt="product">

        <h3><?php echo $row['name']; ?></h3>

        <p class="desc">
           <?php echo $row['description']; ?>
        </p>

        <p class="price">₹<?php echo $row['price']; ?></p>

        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">
            <button class="btn">Add to Cart</button>
        </a>
    </div>

<?php } ?>

</div>

</body>
</html>