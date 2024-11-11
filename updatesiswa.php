<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nis = $_POST['nis'];
    $namasiswa= $_POST['namasiswa'];
    $jk = $_POST['jk'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $tanggallahir = $_POST['tanggallahir'];
    $foto = $_POST['foto'];

$sql_update = "UPDATE siswa SET namasiswa = '$namasiswa', jk = '$jk', phone = '$phone', alamat = '$alamat', tanggallahir = '$tanggallahir', foto = '$foto' WHERE nis = '$nis'";

if ($conn->query($sql_update) === TRUE) {
    header("Location: datasiswa.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}
}

$conn->close();
?>