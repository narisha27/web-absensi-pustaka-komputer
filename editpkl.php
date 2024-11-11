<?php
include 'koneksi.php'; 

if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];


    $sql = "SELECT * FROM datapkl WHERE nama = '$nama'";
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
    $nama = $_POST['nama'];
    $keteranganpkl = $_POST['keteranganpkl'];
    $tanggal = $_POST['tanggal'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if (!empty($foto)) {
        move_uploaded_file($tmp, "assets/img/$foto");
    
        $sql = "UPDATE datapkl SET 
                    nama='$nama', 
                    keteranganpkl='$keteranganpkl', 
                    tanggal='$tanggal', 
                    foto='$foto' 
                WHERE nama='$nama'";
    } else {
        // Update data tanpa mengubah gambar jika tidak ada gambar baru
        $sql = "UPDATE datapkl SET 
                    nama='$nama', 
                    keteranganpkl='$keteranganpkl', 
                WHERE nama='$nama'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: datapkl.php"); // Redirect after successful update
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
    <title>Edit Siswa PKL</title>
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

<h2>Edit Siswa PKL</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="nama" value="<?php echo $row['nama']; ?>">
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br>

    <label for="keteranganpkl">Keterangan PKL:</label><br>
    <input type="text" id="keteranganpkl" name="keteranganpkl" value="<?php echo $row['keteranganpkl']; ?>" required><br>

    <label for="tanggal">Tanggal :</label><br>
    <input type="text" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required><br>

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