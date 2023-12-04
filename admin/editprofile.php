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
    <h1>Halaman Edit Profil</h1>
    <div class="container">    
        <div class="data">
            <form action="./update_profile.php" method="post" enctype="multipart/form-data">
            <div class="isidata">
                <label for="currentPhoto">Foto Profil Saat Ini</label>
                <?php 
                    if (!empty($fotoAdmin)) {
                        $fotoAdmin = resizeImage($fotoAdmin, 100, 100);
                        echo "<img src='data:image/*;base64," . base64_encode($fotoAdmin) . "' alt='Gambar' style='width: 25%; height: auto;'>";
                    } else {
                    echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 25%; height: auto;'>";
                    }
                ?>
                <label>NIP</label>
                <input name="editedNIP" type="text" placeholder="<?=$nipAdmin?>" class="volume" readonly>
                <label>Jenis Kelamin</label>
                <input name="editedGender" type="text" placeholder="<?=$genderAdmin?>" class="volume" readonly>
                <label>Role</label>
                <input name="editedRole" type="text" placeholder="<?=$role?>" class="volume" readonly>
                <label>Nama Lengkap</label>
                <input name="editedNama" type="text" placeholder="<?=$namaAdmin?>" class="volume">
                <label>Alamat</label>
                <input name="editedAlamat" type="text" placeholder="<?=$alamatAdmin?>" class="volume">
                <label>Email</label>
                <input name="editedEmail" type="text" placeholder="<?=$emailAdmin?>" class="volume">
                <label>No. Hp</label>
                <input name="editedNoHp" type="text" placeholder="<?=$noHpAdmin?>" class="volume">
                <label>Ubah Foto Profil</label>
                <input name="editedPhoto" type="file" class="volume">
                <button type="button"><a href="./profile.php">Kembali</a></button>
                <button type="submit" name="btn_simpan_profil">Simpan</button>
                
            </div>
        </form>
        </div>
    </div>
</body>
</html>
