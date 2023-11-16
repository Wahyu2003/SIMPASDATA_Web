<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Tambah Akun Senior</title>
</head>
<body>
    <?php 
    session_start();
    include "../main/menu.php" 
    ?>
    <h1>Halaman Tambah Akun Senior Milik Pembina</h1>

    <div>
        <button type="submit" name="btnTambahSenior"><a href="./menu_manajemen_akun_senior.php">Kembali</a></button>
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table-data-akun-senior" border=1 cellpadding=5 cellspacing=0>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'junior' AND status = 'aktif'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $_SESSION['nisnSiswa'] = $a['nisn'];
                    $namaSiswa = $_SESSION['namaSiswa'] = $a['nama'];
                    $kelasSiswa = $_SESSION['kelasSiswa'] = $a['kelas'];
                    $alamatSiswa = $_SESSION['alamatSiswa'] = $a['alamat'];
                    $genderSiswa = $_SESSION['genderSiswa'] = $a['gender'];

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
                        <td>
                            <a href = "?up&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Jadikan Senior</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_GET['up'])) {
    $nisn = $_GET['nisn'];
    
    $update = mysqli_query($db, "UPDATE siswa SET role = 'senior' WHERE siswa.nisn = '$nisn'");
    if ($update) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Dihapus !!');</script>";
    }
}
?>