<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $ID = $_GET['id'];

    // Ambil data vendor berdasarkan ID
    $sql = "SELECT * FROM vendor WHERE ID = '$ID'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Nama = $row['Nama'];
        $Kontak = $row['Kontak'];
        $Nama_barang = $row['Nama_barang'];
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }


// Proses Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $Nama = $_POST['Nama'];
    $Kontak = $_POST['Kontak'];
    $Nama_barang = $_POST['Nama_barang'];

    $sql = "UPDATE vendor SET Nama = '$Nama', Kontak = '$Kontak', Nama_barang = '$Nama_barang' WHERE ID = '$ID'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
        header("Location: vendor.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor</title>
</head>
<body>
    <div class="main-content">
        <header>
           <center><h1>Update Data Vendor</h1></center>
        </header>
        <form action="" method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <label>Nama:</label>
            <input type="text" name="Nama" value="<?php echo $Nama; ?>" required><br>
            <label>Kontak:</label>
            <input type="text" name="Kontak" value="<?php echo $Kontak; ?>" required><br>
            <label>Nama Barang:</label>
            <input type="text" name="Nama_barang" value="<?php echo $Nama_barang; ?>" required><br>
            <input type="submit" value="Update Data Vendor">
        </form>
    </div>
</body>
</html>
