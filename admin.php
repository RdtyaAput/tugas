<?php
include 'koneksi.php';
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
        <h2>Admin</h2>
        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="inventory.php">INVENTORY</a></li>
            <li><a href="storage.php">STORAGE</a></li>
            <li><a href="vendor.php">VENDOR/SUPLIER</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
           <center> <h1>Data Admin</h1></center>
        </header>
        <table border="1">
            <thead>
                <tr>
                    <th>Nomer ID</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM admin";
                $result = $koneksi->query($sql);


                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Nomor_ID"] . "</td>";
                        echo "<td>" . $row["Nama"] . "</td>";
                        echo "<td>" . $row["Kontak"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
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
