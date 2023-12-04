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
                <label>Kelas</label>
                <input type="text" value="<?=$kelasSiswa?>" class="volume" readonly>
                <label>Alamat</label>
                <input type="text"value="<?=$alamatSiswa?>" class="volume" readonly>
                <label>Jenis Kelamin</label>
                <input type="text" value="<?=$genderSiswa?>" class="volume" readonly>
                <label>Email</label>
                <input type="text" value="<?=$emailSiswa?>" class="volume" readonly>
                <label>No. Hp</label>
                <input type="text" value="<?=$noHpSiswa?>" class="volume" readonly>
                <label>Role</label>
                <input type="text" value="<?=$roleSiswa?>" class="volume" readonly>
                <a href="./home.php">Kembali</a>
                <a href="./editprofile.php">Edit Profil</a>
                
            </div>
        </form>
        </div>
    </div>
</body>
</html>