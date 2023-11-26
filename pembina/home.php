<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <title>SIMPASDATA || Pembina Home</title>
  <style>
    .animate__animated {
      opacity: 0;
      display: inline-block;
    }
  </style>
</head>
<body>
<?php
        include "../main/menu.php";
    ?>
    <h1 class="animate__animated animate__fadeIn" style="--animate-duration: 1s;">Selamat</h1>
    <h1 class="animate__animated animate__fadeIn" style="--animate-duration: 2s;">	Datang</h1>
    <h1 class="animate__animated animate__fadeIn" style="--animate-duration: 3s;">	<?php $namaAdmin = $_SESSION['namaAdmin'];echo $namaAdmin;
    ?></h1>

	
</body>
</html>
