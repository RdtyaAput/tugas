<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $serial_number = $_GET['id'];

    // Query untuk mengambil data berdasarkan Serial_Number
    $sql = "SELECT * FROM inventory WHERE Serial_Number='$serial_number'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serial_number = $_POST['Serial_number'];
    $jenis_barang = $_POST['Jenis_barang'];
    $kuantitas_stok = $_POST['Kuantitas_stok'];
    $nama_barang = $_POST['Nama_barang'];
    $lokasi_gudang = $_POST['Lokasi_gudang'];

    // Query untuk mengupdate data
    $sql = "UPDATE inventory SET Jenis_barang='$jenis_barang', Kuantitas_stok='$kuantitas_stok', Nama_barang='$nama_barang', Lokasi_gudang='$lokasi_gudang' WHERE Serial_Number='$serial_number'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
        header("Location: inventory.php"); // Redirect kembali ke halaman inventory
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
</head>
<body>
    <h1>Update Data Inventory</h1>
    <form action="" method="POST">
        <input type="hidden" name="Serial_number" value="<?php echo $row['Serial_Number']; ?>">
        <label>Jenis Barang:</label>
        <input type="text" name="Jenis_barang" value="<?php echo $row['Jenis_barang']; ?>" required><br>
        <label>Kuantitas Stok:</label>
        <input type="number" name="Kuantitas_stok" value="<?php echo $row['Kuantitas_stok']; ?>" required><br>
        <label>Nama Barang:</label>
        <input type="text" name="Nama_barang" value="<?php echo $row['Nama_barang']; ?>" required><br>
        <label>Lokasi Gudang:</label>
        <input type="text" name="Lokasi_gudang" value="<?php echo $row['Lokasi_gudang']; ?>" required><br>
        <input type="submit" value="Update Data">
    </form>
</body>
</html>
