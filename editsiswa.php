<?php
include 'koneksi.php'; 

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    if (!is_numeric($nis)) {
        echo "ID tidak valid!";
        exit();
    }

    $sql = "SELECT * FROM siswa WHERE nis = '$nis'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
} else {
    echo "ID tidak ditemukan!";
    exit();
}

// Update the record if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $_POST['nis'];
    $namasiswa = $_POST['namasiswa'];
    $jk = $_POST['jk'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $tanggallahir = $_POST['tanggallahir'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if (!empty($foto)) {
        move_uploaded_file($tmp, "assets/img/$foto");
    
        $sql = "UPDATE siswa SET 
                    namasiswa='$namasiswa', 
                    jk='$jk', 
                    phone='$phone', 
                    alamat='$alamat', 
                    tanggallahir='$tanggallahir', 
                    foto='$foto' 
                WHERE nis='$nis'";
    } else {
        // Update data tanpa mengubah gambar jika tidak ada gambar baru
        $sql = "UPDATE siswa SET 
                    namasiswa='$namasiswa', 
                    jk='$jk', 
                    phone='$phone', 
                    alamat='$alamat', 
                    tanggallahir='$tanggallahir' 
                WHERE nis='$nis'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: datasiswa.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <style>
        body {
            background-color: whitesmoke; /* Warna hijau untuk header */
            padding: 20px;
            margin-bottom: 20px;
        }
        
            font-family: Arial, sans-serif;
            text-align: center;
        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
        }
        input[type="text"], input[type="namapegawai"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        input[type="submit"] {
            background-color: ;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

</head>
<body>

<h2>Edit Siswa</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>">
    <label for="nis">Nis:</label><br>
    <input type="text" id="nis" name="nis" value="<?php echo $row['nis']; ?>" required><br>

    <label for="namasiswa">Nama Siswa:</label><br>
    <input type="text" id="namasiswa" name="namasiswa" value="<?php echo $row['namasiswa']; ?>" required><br>

    <label for="jk">Jenis Kelamin:</label><br>
    <input type="text" id="jk" name="jk" value="<?php echo $row['jk']; ?>" required><br>

    <label for="phone">Phone:</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br>

    <label for="alamat">Alamat:</label><br>
    <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br>

    <label for="tanggallahir">Tanggal Lahir:</label><br>
    <input type="text" id="tanggallahir" name="tanggallahir" value="<?php echo $row['tanggallahir']; ?>" required><br>

    <label for="foto">Foto:</label><br>
    <input type="file" id="foto" name="foto">
    <img src="assets/img/<?php echo $row['foto']; ?>" width="100" height="100" alt="Gambar">
<br>
<br>
    <input type="submit" value="Update">
</form>

</body>
</html>

<?php
$conn->close(); // Menutup koneksi
?>