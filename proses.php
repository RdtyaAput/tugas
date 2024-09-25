<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_stok");

if(isset($_POST["login"])){ 
    $username = htmlentities(strip_tags(trim($_POST['username']))); 
    $password = htmlentities(strip_tags(trim($_POST['password']))); 
    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username= '$username' and password = '$password'"); 
    $hitung = mysqli_num_rows($data); 
 
    if ($hitung > 0){ 
        $ambildata = mysqli_fetch_array($data); 
        $role = $ambildata['level']; 
 
        if ($role == 'admin'){ 
            $_SESSION['log'] = 'logged'; 
            $_SESSION['level'] = 'admin'; 
            header('location:dashboard.php'); 
        } else { 
            $_SESSION['log'] = 'logged'; 
            $_SESSION['level'] = 'user'; 
            header('location:dashboard.php'); 
        } 
    } 
} 
?>


