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
    $sql = mysqli_query($db, "SELECT * FROM admin where nip = $nipAdmin");
    while($row = mysqli_fetch_assoc($sql)){
        $fotoAdmin = $row['foto'];
        $nipAdmin = $row['nip'];
        $namaAdmin = $row['nama'];
        $alamatAdmin = $row['alamat'];
        $genderAdmin = ($row['gender'] == 'L') ? "Laki-laki" : "Perempuan";
        $emailAdmin = $row['email'];
        $noHpAdmin = $row['no_hp'];
        $roleAdmin = $row['role'];
        $passAdmin = $row['password'];

    }
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
                <input name="editedNIP" type="text" value="<?=$nipAdmin?>" class="volume" readonly>
                <label>Jenis Kelamin</label>
                <input name="editedGender" type="text" placeholder="<?=$genderAdmin?>" class="volume" readonly>
                <label>Role</label>
                <input name="editedRole" type="text" placeholder="<?=$role?>" class="volume" readonly>
                <label>Nama Lengkap</label>
                <input name="editedNama" type="text" placeholder="<?=$namaAdmin?>" class="volume" readonly>
                <label>Alamat</label>
                <input name="editedAlamat" type="text" value="<?=$alamatAdmin?>" class="volume">
                <label>Email</label>
                <input name="editedEmail" type="text" value="<?=$emailAdmin?>" class="volume">
                <label>No. Hp</label>
                <input name="editedNoHp" type="text" value="<?=$noHpAdmin?>" class="volume">
                <label>Password</label>
                <input name="editedPassword" type="text" value="<?=$passAdmin?>" class="volume">
                <label>Ubah Foto Profil</label>
                <input name="foto" type="file" accept="image/*" id="foto" class="volume">

                <button type="button"><a href="./profil.php">Kembali</a></button>
                <button type="submit" name="btn_simpan_profil">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
