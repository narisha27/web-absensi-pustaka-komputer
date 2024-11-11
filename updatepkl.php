<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $keteranganpkl = $_POST['keteranganpkl'];
    $tanggal = $_POST['tanggal'];
    $foto = $_POST['foto'];

$sql_update = "UPDATE datapkl SET nama = '$nama', keteranganpkl = '$keteranganpkl', tanggal = '$tanggal', foto = '$foto' WHERE nama = '$nama'";

if ($conn->query($sql_update) === TRUE) {
    header("Location: datapkl.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}
}

$conn->close();
?>