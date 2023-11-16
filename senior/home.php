<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Senior Home</title>
</head>
<body>
    <?php
        session_start();
        include "../main/menu.php";
    ?>

    <h1>Halaman Home Senior, Selamat Datang 
    <?php 
        $namaSiswa = $_SESSION['namaSiswa'];
        echo $namaSiswa;
    ?>
    </h1>
    
</body>
</html>