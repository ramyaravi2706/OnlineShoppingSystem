<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

$conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");

header("Location: cart.php");
?>