<?php
include 'koneksi.php'; // Menyertakan file koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil dan membersihkan input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pw = mysqli_real_escape_string($conn, $_POST['pw']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    
    // Meng-hash password sebelum menyimpannya
    $hashed_password = password_hash($w, PASSWORD_DEFAULT);

    // Buat query untuk menyimpan data pengguna
    $query = "INSERT INTO user (username, pw, nama, email, level) VALUES ('$username', '$hashed_password', '$nama', '$email', '$level')";
    
    // Eksekusi query dan cek hasil
    if (mysqli_query($conn, $query)) {
        header("Location: login.php"); // Redirect ke halaman login setelah pendaftaran sukses
        exit();
    } else {
        $error = "Username sudah terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun</title>
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
    select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1em;
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
        <h1>Pendaftaran Akun</h1>
        <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
        <input type="text" name="username" value="" placeholder="Username" required>
        <input type="text" name="password" value="" placeholder="Password" required>
        <input type="text" name="nama" value="" placeholder="Nama" required>
        <input type="text" name="email" value="" placeholder="Email" required>
        <!-- Dropdown untuk memilih level -->
        <select name="level" required>
                <option value="" disabled selected>Pilih Level</option>
                <option value="admin">Admin</option>
                <option value="siswapkl">Siswa PKL</option>
                <option value="pembimbing">Pembimbing</option>
            </select>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>
</body>

</html>