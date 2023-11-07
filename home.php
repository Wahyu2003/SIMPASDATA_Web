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
    <link href="css/home.css" rel="stylesheet">
    <script src="js/home.js"></script>
    <title>Home</title>
</head>
<body>
    <!-- <div class="container">
    <h1>Selamat Datang <?php echo $userName; ?></h1>
    <a href="login.php" class="btn btn-primary">LOGOUT</a>
    </div> -->
        
    <!-- sidebar -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pasdata</title>
</head>
<body>
<nav>
        <div class="logo">Pasdata</div>
        <div class="toggle-menu" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </nav>
    <aside class="sidebar">
        <div class="menu-items">
            <a href="#">Dashboard</a>
            <a href="#">Manajemen Akun</a>
            <a href="#">Pembina</a>
            <a href="#">Senior</a>
            <a href="#">Input Nilai Senior</a>
            <a href="#">Nilai Sikap</a>
            <a href="#">Nilai Pola Pikir</a>
            <a href="#">Nilai Keaktifan</a>
        </div>
    </aside>
    
    <!-- Content -->
    <main class="main-content">
    <div class="container">
    <h1>Selamat Datang <?php echo $userName; ?></h1>
    <a href="login.php" class="btn btn-primary">LOGOUT</a>
    </div>
    </main>

</body>
</html>
</body>
</html>