<?php
include 'koneksi.php'; 

$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .button-group {
            margin-bottom: 20px;
        }
        
       /* Reset margin dan padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Navbar styling */
    body {
        font-family: Arial, sans-serif;
    }

    .navbar {
        background-color: blue; /* Hijau Tua */
        overflow: hidden;
        padding: 10px 10px;
        display: flex;
        align-items: center;
    }

    /* Navbar items */
    .navbar a {
        color: white;
        padding: 10px 10px;
        text-decoration: none;
        font-size: 17px;
    }

    .navbar a:hover {
        background-color: lightblue; /* Warna hijau lebih terang saat hover */
    }

    /* Kolom Pencarian */
    .search-container {
        margin-left: auto;
        display: flex;
        align-items: center;
    }

    .search-container input[type="text"] {
        padding: 8px;
        font-size: 16px;
        border: none;
        border-radius: 4px 0 0 4px;
        outline: none;
    }

    .search-container button {
        padding: 8px 10px;
        background-color: lightblue;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
    }

    .search-container button:hover {
        background-color: #1E7A1E;
    }
    </style>
</head>
<body>
<div class="navbar">
    <a href="index.html"><h4>Pustaka Komputer</h4></a>
    <a href="home.php">Home</a>
    <a href="datasiswa.php">Data Siswa</a>
    <a href="datapkl.php">Data PKL</a>
    <a href="datauser.php">Data User</a>

    <!-- Kolom Pencarian -->
    <div class="search-container">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>
</div>

<br>

<div style="text-align: center;">
    <h1>Data Siswa PKL Periode Juli-September 2024</h1>
</div>

<table>
    <tr>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Jenis Kelamin</th>
        <th>Phone</th>
        <th>Alamat</th>
        <th>Tanggal lahir</th>
        <th>Foto</th>

    </tr>
    <?php
include 'koneksi.php'; 
$no = 1;
$data = mysqli_query($conn, 'SELECT * FROM siswa');
while ($result = mysqli_fetch_array($data)) {
    echo "
    <tr>
        <td>".$result['nis']."</td>
        <td>".$result['namasiswa']."</td>
        <td>".$result['jk']."</td>
        <td>".$result['phone']."</td>
        <td>".$result['alamat']."</td>
        <td>".$result['tanggallahir']."</td>
        <td><img src='assets/img/".$result['foto']."' width='100' height='100'></td>
        
        </td>
    </tr>";
    $no++;
}
?>

</table>

<div class="button-group" style="text-align: center; margin-bottom: 20px;">
    <a href="index.html" class="btn btn-primary">Ke Menu Home</a>
</div>
<div style="text-align: center;">
&copy; <?php echo date("Y"); ?> PPLG All Right reserved.
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

<?php
$conn->close();
?>
