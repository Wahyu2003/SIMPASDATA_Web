<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Pembina Home</title>
</head>
<body>
    <?php 
    session_start();
    include "../main/menu.php";
    ?>
    <h1>Halaman Home Pembina, Selamat Datang <?php 
        if(isset($_SESSION['role']) == 'pembina'){
            $namaAdmin;
        }elseif (isset($_SESSION['role']) == 'admin') {
            $namaAdmin;
        }elseif (isset($_SESSION['role']) == 'senior') {
            $namaSiswa;
        }
    ?>
    </h1>
</body>
</html>