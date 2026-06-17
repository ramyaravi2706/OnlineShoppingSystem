<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$user'");

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($pass, $row['password'])){
            $_SESSION['user_id'] = $row['id'];

            // ✅ REDIRECT TO PRODUCTS PAGE
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(to right, #2193b0, #6dd5ed);
    font-family: Arial;
}
.box {
    background:white;
    padding:30px;
    border-radius:10px;
    text-align:center;
}
input {
    display:block;
    margin:10px auto;
    padding:10px;
    width:200px;
}
button {
    padding:10px;
    width:100%;
    background:#2193b0;
    color:white;
    border:none;
    cursor:pointer;
}
button:hover {
    background:#176d85;
}
</style>
</head>
<body>

<div class="box">
<h2>Login</h2>
<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
</form>
</div>

</body>
</html>