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

    }
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