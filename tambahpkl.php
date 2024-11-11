<?php
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa PKL</title>
</head>
<style>
    /* CSS sama seperti sebelumnya */
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
    <h1>Tambah Data Siswa PKL</h1>
    <img src="logo1.png" alt="" width="120px">
    <form action="" method="POST" enctype="multipart/form-data">
        <br>
        <table border="1">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Keterangan PKL</td>
                <td>:</td>
                <td><input type="text" name="keteranganpkl" required></td>
            </tr>
            <tr>
                <td>Tanggal </td>
                <td>:</td>
                <td><input type="date" name="tanggal" required></td>
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
    $nama = $_POST['nama'] ?? null;
    $keteranganpkl = $_POST['keteranganpkl'] ?? null;
    $tanggal = $_POST['tanggal'] ?? null;
    $foto = $_FILES['foto']['name'] ?? null;

    if ($foto) {
        $target_dir = "assets/img/";
        $target_file = $target_dir . basename($foto);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi format file
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO datapkl (nama, keteranganpkl, tanggal, foto)
                        VALUES ('$nama', '$keteranganpkl', '$tanggal', '$foto')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Data berhasil disimpan'); window.location.href='datapkl.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengupload gambar.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan</div>";
        }
    }
}
?>
