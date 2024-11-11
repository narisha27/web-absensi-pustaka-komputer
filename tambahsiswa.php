<?php
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
</head>
<style>
    body {
        background-image: url("bg.jpg");
        font-family : "Times New Roman", Times, serif;
    }
    .container {
        text-align: center;
        margin-top: 10px;
    }
    h1, h2 {
        color: black;
    }
    table {
        margin: auto;
        border-collapse: collapse;
        width: 40%;
        background-color: white;
        color: black;
    }
    table, th, td {
        border: 1px solid black;
    }
    td {
        padding: 5px;
        text-align: left;
    }
    input[type="text"], input[type="tel"], textarea, select {
        width: 50%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    input[type="submit"] {
        padding: 10px 10px;
        background-color: white;
        color: black;
        border: 1px solid #000;
        cursor: pointer;
        border-radius: 3px;
    }
    input[type="submit"]:hover {
        background-color: lightgray;
    }
</style>
<body>
    <center>
    <h1>Tambah Data Siswa</h1>
    <img src="logo1.png" alt="" width="120px">
    <form action="" method="POST" enctype="multipart/form-data">
        <br>
        <table border="1">
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><input type="text" name="nis" required></td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td><input type="text" name="namasiswa" required></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><input type="text" name="jk" required></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><input type="text" name="phone" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" name="tanggallahir" required></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>:</td>
                <td><input type="file" name="foto" required></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <input type="submit" value="Daftar">
                </td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = isset($_POST['nis']) ? $_POST['nis'] : null;
    $namasiswa = isset($_POST['namasiswa']) ? $_POST['namasiswa'] : null;
    $jk = isset($_POST['jk']) ? $_POST['jk'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;
    $tanggallahir = isset($_POST['tanggallahir']) ? $_POST['tanggallahir'] : null;
    $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : null;

    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($foto);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan</div>";
    } else {
        if (isset($_FILES['foto']['tmp_name']) && move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO siswa (nis, namasiswa,  jk, phone, alamat, tanggallahir, foto)
                    VALUES ('$nis', '$namasiswa', '$jk', '$phone', '$alamat', '$tanggallahir', '$foto')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Data berhasil disimpan'); window.location.href='datasiswa.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengupload gambar.</div>";
        }
    }
}
?>