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
        $namaAdmin = $_SESSION['namaAdmin'];
        echo $namaAdmin;
    ?>
    </h1>

    
    
</body>
</html>