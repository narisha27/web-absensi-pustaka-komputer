<?php 

include ("koneksi.php");
$query = mysqli_query($conn, "DELETE FROM user WHERE username='".$_GET['username']."' ");
header('location: datauser.php')
?>