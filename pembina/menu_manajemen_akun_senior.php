<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Senior</title>
</head>
<body>
    <?php 
    session_start();
    include "../main/menu.php" 
    ?>
    <h1>Halaman Manajemen Akun Senior Milik Pembina</h1>

    <div>
        <button type="submit" name="btnTambahSenior"><a href="./menu_manajemen_tambah_senior.php">Tambah Akun</a></button>
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
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'senior' AND status = 'aktif'");

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
                            <a href = "./menu_manajemen_detail_senior.php?nisn=<?= $nisnSiswa?>" class='detail'>Detail</a>
                            <a href = "?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_GET['delete'])) {
    $nisn = $_GET['nisn'];
    
    $delete = mysqli_query($db, "UPDATE siswa SET status = 'tidak' WHERE siswa.nisn = '$nisn'");
    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Dihapus !!');</script>";
    }
}
?>