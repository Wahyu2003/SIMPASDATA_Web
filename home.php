<?php
require ('koneksi.php');
session_start();
if (isset($_SESSION['nama'])) {
    $userName = $_SESSION['nama'];
} else {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="container">
        
    <h1>Selamat Datang <?php echo $userName; ?></h1>
    <a href="login.php" class="btn btn-primary">LOGOUT</a>
</body>
</html>