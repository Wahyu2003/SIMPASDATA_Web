<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Senior Home</title>
    
</head>
<body>
  </body>
    <?php
        
        include "../main/menu.php";
    ?>
<center>
<h1>Halaman Home Senior, Selamat Datang 
    <?php 
        $namaSiswa = $_SESSION['namaSiswa'];
        echo $namaSiswa;
    ?>
    </h1>
    
</center>
    
</body>
</html>