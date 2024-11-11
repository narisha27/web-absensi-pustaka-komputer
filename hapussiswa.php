<?php 

include ("koneksi.php");
$query = mysqli_query($conn, "DELETE FROM siswa WHERE nis='".$_GET['nis']."' ");
header('location: datasiswa.php')
?>