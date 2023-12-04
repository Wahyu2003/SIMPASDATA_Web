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

    $nisnSiswa = $_SESSION['nisnSiswa'];
    $fotoSiswa = $_SESSION['fotoSiswa'];
    $namaSiswa = $_SESSION['namaSiswa'];
    $alamatSiswa = $_SESSION['alamatSiswa'];
    $genderSiswa = ($_SESSION['genderSiswa'] == 'L') ? "Laki-laki" : "Perempuan"; 
    $emailSiswa = $_SESSION['emailSiswa'];
    $noHpSiswa = $_SESSION['noHpSiswa'];
    $passwordSiswa = $_SESSION['passwordSiswa'];
    $role = $_SESSION['roleSiswa'];
    ?>
    <h1>Halaman Profil</h1>
    <div class="container">
        
        <div class="foto">
            <?php 
            if (!empty($fotoSiswa)) {
                $fotoSiswa = resizeImage($fotoSiswa, 100, 100);
                echo "<img src='data:image/*;base64," . base64_encode($fotoSiswa) . "' alt='Gambar' style='width: 50%; height: auto;'>";
            } else {
              echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 50%; height: auto;'>";
          }
            ?>
        </div>
    
        <div class="data">
            <form method="post">
            <div class="isidata">
                
                <label>NISN</label>
                <input type="text" value="<?=$nisnSiswa?>" class="volume" readonly>
                <label>Nama Lengkap</label>
                <input type="text" value="<?=$namaSiswa?>" class="volume" readonly>
                <label>Alamat</label>
                <input type="text"value="<?=$alamatSiswa?>" class="volume" readonly>
                <label>Jenis Kelamin</label>
                <input type="text" value="<?=$genderSiswa?>" class="volume" readonly>
                <label>Email</label>
                <input type="text" value="<?=$emailSiswa?>" class="volume" readonly>
                <label>No. Hp</label>
                <input type="text" value="<?=$noHpSiswa?>" class="volume" readonly>
                <label>Role</label>
                <input type="text" value="<?=$role?>" class="volume" readonly>
                <button type="button">Kembali</button>
                <button type="button">Edit Profil</button>
                
            </div>
        </form>
        </div>
    </div>
</body>
</html>