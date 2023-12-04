<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>
    <?php
    include "../main/menu.php";

    $nipAdmin = $_SESSION['nipAdmin'];
    $fotoAdmin = $_SESSION['fotoAdmin'];
    $namaAdmin = $_SESSION['namaAdmin'];
    $alamatAdmin = $_SESSION['alamatAdmin'];
    $genderAdmin = ($_SESSION['genderAdmin'] == 'L') ? "Laki-laki" : "Perempuan";
    $emailAdmin = $_SESSION['emailAdmin'];
    $noHpAdmin = $_SESSION['noHpAdmin'];
    $passwordAdmin = $_SESSION['passwordAdmin'];
    $role = $_SESSION['roleAdmin'];
    ?>
    <h1>Halaman Profil</h1>
    <div class="container">
        
        <div class="foto">
            <?php 
            if (!empty($fotoAdmin)) {
                $fotoAdmin = resizeImage($fotoAdmin, 100, 100);
                echo "<img src='data:image/*;base64," . base64_encode($fotoAdmin) . "' alt='Gambar' style='width: 50%; height: auto;'>";
            } else {
              echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 50%; height: auto;'>";
          }
            ?>
        </div>
    
        <div class="data">
            <form method="post">
            <div class="isidata">
                
                <label>NIP</label>
                <input type="text" value="<?=$nipAdmin?>" class="volume" readonly>
                <label>Nama Lengkap</label>
                <input type="text" value="<?=$namaAdmin?>" class="volume" readonly>
                <label>Alamat</label>
                <input type="text"value="<?=$alamatAdmin?>" class="volume" readonly>
                <label>Jenis Kelamin</label>
                <input type="text" value="<?=$genderAdmin?>" class="volume" readonly>
                <label>Email</label>
                <input type="text" value="<?=$emailAdmin?>" class="volume" readonly>
                <label>No. Hp</label>
                <input type="text" value="<?=$noHpAdmin?>" class="volume" readonly>
                <label>Role</label>
                <input type="text" value="<?=$role?>" class="volume" readonly>
                <a href="./home.php">Kembali</a>
                <a href="./editprofile.php">Edit Profil</a>
                
                
            </div>
        </form>
        </div>
    </div>
</body>
</html>