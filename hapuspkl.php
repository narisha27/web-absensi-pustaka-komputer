<?php 

include ("koneksi.php");
$query = mysqli_query($conn, "DELETE FROM datapkl WHERE nama='".$_GET['nama']."' ");
header('location: datapkl.php')
?>