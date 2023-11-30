<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Tambah Akun Senior</title>
    <link rel="stylesheet" href="../assets/css/manajemen.css">
    
</head>

<body>
    <?php
    include "../main/menu.php"
    ?>
    <h1>Halaman Tambah Akun Senior Milik Pembina</h1>
<div class="container">
<a href="./menu_manajemen_akun_senior.php" class="kembali">Kembali</a>

    
    <br>
    <div class="table">
        <table class>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.email, siswa.no_hp FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'junior' AND status = 'aktif'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $a['nisn'];
                    $namaSiswa = $a['nama'];
                    $kelasSiswa = $a['kelas'];
                    $alamatSiswa = $a['alamat'];
                    $genderSiswa = $a['gender'];
                    $emailSiswa = $a['email'];
                    $noHpSiswa = $a['no_hp'];

                    if($genderSiswa == 'L'){
                        $genderSiswa = "Laki - Laki";
                    }else{
                        $genderSiswa = "Perempuan";
                    }
                    ?>
                    <tr>
                        <td><?= $nisnSiswa ?></td>
                        <td><?= $namaSiswa ?></td>
                        <td><?= $kelasSiswa ?></td>
                        <td><?= $alamatSiswa ?></td>    
                        <td><?= $genderSiswa ?></td>
                        <td><?= $emailSiswa ?></td>
                        <td><?= $noHpSiswa ?></td>
                        <td>
                            <a href = "?update&nisn=<?= $nisnSiswa ?>"class="jadikansenior" onclick="return confirm('Apakah kamu yakin ?')">Jadikan Senior</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
    
   
</body>
</html>

<?php
if (isset($_GET['update'])) {
    $nisn = $_GET['nisn'];

    $update = mysqli_query($db, "UPDATE siswa SET role = 'senior', status='aktif', level='denied' WHERE siswa.nisn = '$nisn'");
    if ($update) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Diupdate!!');</script>";
    }
}
?>
