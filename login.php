<?php
require 'function.php';

$error = false;

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($conn, $username);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $password;
            echo "<script>alert('Login successful!');</script>";
            header("Location: halaman_utama.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if ($error) : ?>
            <p class="error-message">Username atau password salah!</p>
        <?php endif; ?>

        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Register disini</a></p>
    </div>
</body>
</html>