<?php
session_start();
include 'db.php';

if(isset($_GET['id'])){
    $cart_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // delete only that user's item
    $conn->query("DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id");
}

header("Location: cart.php");
exit();
?>