<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $ID = $_POST['ID'];
    $Nama_gudang = $_POST['Nama_gudang'];
    $Lokasi = $_POST['Lokasi'];


    $sql = "INSERT INTO storage (ID, Nama_gudang, Lokasi) 
            VALUES ( '$ID', '$Nama_gudang', '$Lokasi')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
        header("Location: storage.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}

if(isset($_GET['id'])){
   $ID = $_GET['id'];
 
   $sql="DELETE FROM storage where ID = '$ID'";

   if($koneksi->query($sql)=== TRUE){
    echo "Data Berhasil Dihapus";
    header("location: storage.php");
    exit();
   }else{
    echo "erorr" . $koneksi->error;
   }
   $koneksi->close();
}else{
    echo"id tidak valid";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css.css"> 
    <style>
    .main-content {
        width: 90%; 
        margin: 0 auto; 
    }
    table {
        width: 60%; 
        margin: 20px auto; 
        border-collapse: collapse;
        font-size: 14px; 
    }

    th, td {
        padding: 6px; 
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
    <div class="sidebar">
        <h2>Storage</h2>
        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="inventory.php">INVENTORY</a></li>
            <li><a href="vendor.php">VENDOR/SUPLIER</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
           <center> <h1>Data Storage</h1></center>
        </header>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="ID" required></td>
                </tr>
                <tr>
                    <td>Nama Gudang:</td>
                    <td><input type="text" name="Nama_gudang" required></td>
                </tr>
                <tr>
                    <td>Lokasi:</td>
                    <td><input type="text" name="Lokasi" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="tambah data">
                    </td>
            </table>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Gudang</th>
                    <th>Lokasi</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM storage";
                $result = $koneksi->query($sql);


                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["Nama_gudang"] . "</td>";
                        echo "<td>" . $row["Lokasi"] . "</td>";
                        echo "<td>";
                        echo "<a href='storage_update.php?id=" . $row["ID"] . "'>Update</a> | ";
                        echo "<td>";
                        echo "<a href='storage.php?id=" . $row["ID"] . "' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Delete</a>";
                        echo"</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data dosen ditemukan</td></tr>";
                }               
                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
