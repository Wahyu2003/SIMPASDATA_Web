<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Admin Home</title>
</head>
<body>
    <?php
        include "../main/menu.php";
    ?>
    <h1>Halaman Home Admin, Selamat Datang <?php 
        if(isset($_SESSION['roleAdmin']) == 'pembina'){
            $namaAdmin;
        }elseif (isset($_SESSION['roleAdmin']) == 'admin') {
            $namaAdmin;
        }elseif (isset($_SESSION['roleSiswa']) == 'senior') {
            $namaSiswa;
        }else{
            echo "Gagal mencari nama";
        }
    ?>
    </h1>
</body>
</html>