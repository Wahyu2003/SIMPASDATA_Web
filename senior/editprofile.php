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
    $sql = mysqli_query($db, "SELECT siswa.nama, siswa.foto, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.email, siswa.no_hp, siswa.password, siswa.role FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id_kelas where siswa.nisn = $nisnSiswa");
    while($row = mysqli_fetch_assoc($sql)){
        $fotoSiswa = $row['foto'];
        $namaSiswa = $row['nama'];
        $kelasSiswa = $row['kelas'];
        $alamatSiswa = $row['alamat'];
        $genderSiswa = ($row['gender'] == 'L') ? "Laki-laki" : "Perempuan";
        $emailSiswa = $row['email'];
        $noHpSiswa = $row['no_hp'];
        $passwordSiswa = $row['password'];
        $roleSiswa = $row['role'];

    }
    ?>
    <h1>Halaman Edit Profil</h1>
    <div class="container">    
        <div class="data">
            <form action="./update_profile.php" method="post" enctype="multipart/form-data">
            <div class="isidata">
                <label for="currentPhoto">Foto Profil Saat Ini</label>
                <?php 
                    if (!empty($fotoSiswa)) {
                        $fotoSiswa = resizeImage($fotoSiswa, 100, 100);
                        echo "<img src='data:image/*;base64," . base64_encode($fotoSiswa) . "' alt='Gambar' style='width: 25%; height: auto;'>";
                    } else {
                    echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 25%; height: auto;'>";
                    }
                ?>
                <label>NISN</label>
                <input name="editedNISN" type="text" value="<?=$nisnSiswa?>" class="volume" readonly>
                <label>Kelas</label>
                <input name="editedKelas" type="text" placeholder="<?=$kelasSiswa?>" class="volume" readonly>
                <label>Jenis Kelamin</label>
                <input name="editedGender" type="text" placeholder="<?=$genderSiswa?>" class="volume" readonly>
                <label>Role</label>
                <input name="editedRole" type="text" placeholder="<?=$roleSiswa?>" class="volume" readonly>
                <label>Nama Lengkap</label>
                <input name="editedNama" type="text" placeholder="<?=$namaSiswa?>" class="volume" readonly>
                <label>Alamat</label>
                <input name="editedAlamat" type="text" value="<?=$alamatSiswa?>" class="volume">
                <label>Email</label>
                <input name="editedEmail" type="text" value="<?=$emailSiswa?>" class="volume">
                <label>No. Hp</label>
                <input name="editedNoHp" type="text" value="<?=$noHpSiswa?>" class="volume">
                <label>Password</label>
                <input name="editedPassword" type="text" value="<?=$passwordSiswa?>" class="volume">
                <label>Ubah Foto Profil</label>
                <input name="editedPhoto" type="file" class="volume">
                <button type="button"><a href="./profil.php">Kembali</a></button>
                <button type="submit" name="btn_simpan_profil">Simpan</button>
                
            </div>
        </form>
        </div>
    </div>
</body>
</html>
