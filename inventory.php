<?php
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $Serial_number = $_POST['Serial_number'];
    $Jenis_barang = $_POST['Jenis_barang'];
    $Kuantitas_stok = $_POST['Kuantitas_stok'];
    $Nama_barang = $_POST['Nama_barang'];
    $Lokasi_gudang = $_POST['Lokasi_gudang'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO inventory (Serial_Number, Jenis_barang, Kuantitas_stok, Nama_barang, Lokasi_gudang) 
            VALUES ('$Serial_number', '$Jenis_barang', '$Kuantitas_stok', '$Nama_barang', '$Lokasi_gudang')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
        header("Location: inventory.php"); // Redirect kembali ke halaman inventory
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}

if (isset($_GET['id'])) {
    $Serial_number = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM inventory WHERE Serial_Number='$Serial_number'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
        header("Location: inventory.php"); // Redirect kembali ke halaman inventory
        exit();
    } else {
        echo "Error: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    echo "ID tidak valid!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
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
        <h2>Inventory</h2>
        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="storage.php">STORAGE</a></li>
            <li><a href="vendor.php">VENDOR/SUPLIER</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
           <center><h1>Data Inventory</h1></center>
        </header>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Serial Number:</td>
                    <td><input type="text" name="Serial_number" required></td>
                </tr>
                <tr>
                    <td>Jenis Barang:</td>
                    <td><input type="text" name="Jenis_barang" required></td>
                </tr>
                <tr>
                    <td>Kuantitas Stok:</td>
                    <td><input type="number" name="Kuantitas_stok" required></td>
                </tr>
                <tr>
                    <td>Nama Barang:</td>
                    <td><input type="text" name="Nama_barang" required></td>
                </tr>
                <tr>
                    <td>Lokasi Gudang:</td>
                    <td><input type="text" name="Lokasi_gudang" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Tambah Data">
                    </td>
                </tr>
            </table>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Jenis barang</th>
                    <th>Kuantitas stok</th>
                    <th>Lokasi gudang</th>
                    <th>Nama barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM inventory";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Serial_Number"] . "</td>";
                        echo "<td>" . $row["Jenis_barang"] . "</td>";
                        echo "<td>" . $row["Kuantitas_stok"] . "</td>";
                        echo "<td>" . $row["Nama_barang"] . "</td>";
                        echo "<td>" . $row["Lokasi_gudang"] . "</td>";
                        echo "<td>";
                        echo "<a href='update_inventory.php?id=" . $row["Serial_Number"] . "'>Update</a> | ";
                        echo "<td>";
                        echo "<a href='inventory.php?id=" . $row["Serial_Number"] . "' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data ditemukan</td></tr>";
                }               
                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
