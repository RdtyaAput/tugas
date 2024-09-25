<?php
include 'koneksi.php';

if(isset($_GET['id'])){
    $ID = $_GET['id'];

    // Ambil data dari database berdasarkan ID
    $sql = "SELECT * FROM storage WHERE ID = '$ID'";
    $result = $koneksi->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Nama_gudang = $row['Nama_gudang'];
        $Lokasi = $row['Lokasi'];
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

// Proses update data
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ID = $_POST['ID'];
    $Nama_gudang = $_POST['Nama_gudang'];
    $Lokasi = $_POST['Lokasi'];

    // Query untuk meng-update data
    $sql = "UPDATE storage SET Nama_gudang = '$Nama_gudang', Lokasi = '$Lokasi' WHERE ID = '$ID'";

    if($koneksi->query($sql) === TRUE){
        echo "Data berhasil diupdate!";
        header("Location: storage.php");
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
    <title>Update Storage</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="main-content">
        <header>
           <center><h1>Update Data Storage</h1></center>
        </header>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="ID" value="<?php echo $ID; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Nama Gudang:</td>
                    <td><input type="text" name="Nama_gudang" value="<?php echo $Nama_gudang; ?>" required></td>
                </tr>
                <tr>
                    <td>Lokasi:</td>
                    <td><input type="text" name="Lokasi" value="<?php echo $Lokasi; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Update Data">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
