<?php
session_start(); // Memulai sesi
include 'koneksi.php'; // Menyertakan file koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil dan membersihkan input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pw = mysqli_real_escape_string($conn, $_POST['pw']);

    // Mengambil data pengguna dari database
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (password_verify($pw, $user['pw'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level']; 

           // Redirect based on user level
if ($user['level'] == 'admin' || $user['level'] == 'admin') {
    header("Location: home.php"); 
    exit;
} elseif ($user['level'] == 'user' || $user['level'] == 'siswapkl') { 
    // User or siswa pkl both redirect to user.php
    header("Location: user.php"); 
    exit;
} elseif ($user['level'] == 'pembimbing' || $user['level'] == 'pembimbing') {
    header("Location: user3.php"); 
    exit;
}
else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}

    // Memeriksa password
    if ($user && password_verify($pw, $user['pw'])) {
        // Jika berhasil, simpan informasi pengguna di sesi
        $_SESSION['username'] = $username;
        header("Location: home.php"); // Redirect ke home.php
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
     body {
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	background-color: #f0f4f8;
	margin: 200;
	padding: 80px;
	background-image: url(img/background1.png);
    background-size : cover;
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: transparent;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        text-align: center;
    }
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
    <div class="container">
      <h1><img src="assets/img/puskom.png" width="300" height="100"></h1>
        <h1>Login </h1>
        <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
        <input type="text" name="username" value="" placeholder="Username" required>
        <input type="text" name="password" value="" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        <p align="center"><strong>Copyright 2024 @ Pustaka Komputer </strong></p>
</div>
</body>

</html>