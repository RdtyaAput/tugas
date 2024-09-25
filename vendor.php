<?php
include 'koneksi.php';

// Proses Insert Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['insert'])) {
        $Nama = $_POST['Nama'];
        $Kontak = $_POST['Kontak'];
        $Nama_barang = $_POST['Nama_barang'];

        $sql = "INSERT INTO vendor (Nama, Kontak, Nama_barang) 
                VALUES ('$Nama', '$Kontak', '$Nama_barang')";

        if ($koneksi->query($sql) === TRUE) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
}

// Proses Delete Data
if (isset($_GET['delete_id'])) {
    $ID = $_GET['delete_id'];
    $sql = "DELETE FROM vendor WHERE ID = '$ID'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Management</title>
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
        <h2>Vendor</h2>
        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="inventory.php">INVENTORY</a></li>
            <li><a href="storage.php">STORAGE</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <center><h1>Data Vendor</h1></center>
        </header>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="ID" required></td>
                </tr>
                <tr>
                    <td>Nama:</td>
                    <td><input type="text" name="Nama" required></td>
                </tr>
                <tr>
                    <td>Kontak:</td>
                    <td><input type="number" name="Kontak" required></td>
                </tr>
                <tr>
                    <td>Nama Barang:</td>
                    <td><input type="text" name="Nama_barang" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="tambah data">
                    </td>
            </table>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Nama Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil Data Vendor
                $sql = "SELECT * FROM vendor";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["Nama"] . "</td>";
                        echo "<td>" . $row["Kontak"] . "</td>";
                        echo "<td>" . $row["Nama_barang"] . "</td>";
                        echo "<td>";
                        echo "<a href='update_vendor.php?id=" . $row["ID"] . "'>Update</a> | ";
                        echo "<a href='vendor.php?delete_id=" . $row["ID"] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data vendor ditemukan</td></tr>";
                }

                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
